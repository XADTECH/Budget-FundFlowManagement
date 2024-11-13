<?php

namespace App\Http\Controllers;
use App\Models\BudgetProject;
use App\Models\CashFlow;
use App\Models\Bank;
use App\Models\Invoice;
use App\Models\Sender;
use App\Models\LedgerEntry;
use App\Models\TotalBudgetAllocated;
use App\Models\TransferFromManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CashFlowController extends Controller
{
    //
    // Show the form to create a cash flow entry
    public function create()
    {
        $budgetProjects = BudgetProject::all();
        $banks = Bank::all();

        return view('content.pages.page-cashflow-form', compact('budgetProjects', 'banks')); // Name of your Blade view for the form
    }

    public function store(Request $request)
    {
        // return response($request->all());
        // Initial validation for required fields

        $request->validate([
            'date' => 'required|date',
            'fund_type' => 'required|string',
            'main_category' => 'required|string',
        ]);

        $fundType = $request->fund_type;
        $mainCategory = $request->main_category;
        if ($request->fund_type === 'Inflow') {
            switch ($request->main_category) {
                case 'Invoice':
                    // Validation rules
                    $request->validate([
                        'fund_type' => 'required|string',
                        'main_category' => 'required|string',
                        'invoice_number' => 'required|string',
                        'invoice_dr_amount_received' => 'required|numeric',
                        'invoice_budget_project_id' => 'required|integer',
                        'invoice_fund_category' => 'required|string',
                        'invoice_destination_account' => 'required|integer',
                        'item_description' => 'required|array',
                        'item_description.*' => 'string',
                        'amount' => 'required|array',
                        'amount.*' => 'numeric',
                        'invoice_file' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max file size
                        'invoice_sender_name' => 'required|string',
                        'invoice_sender_bank_name' => 'required|string',
                        'invoice_sender_bank_account' => 'required|string',
                        'sender_detail' => 'nullable|string',
                    ]);

                    // Process the invoice data
                    $invoiceData = [
                        'date' => $request->date,
                        'invoice_number' => $request->invoice_number,
                        'invoice_dr_amount_received' => $request->invoice_dr_amount_received,
                        'invoice_fund_category' => $request->invoice_fund_category,
                        'invoice_destination_account' => $request->invoice_destination_account,
                        'item_description' => json_encode($request->item_description), // Storing as JSON
                        'amount' => json_encode($request->amount), // Storing as JSON
                        'invoice_budget_project_id' => $request->invoice_budget_project_id,
                    ];

                    // Handle file upload if it exists
                    if ($request->hasFile('invoice_file')) {
                        $file = $request->file('invoice_file');
                        $path = $file->store('invoices', 'public');
                        $invoiceData['invoice_file'] = $path; // Store the path in the database
                    }

                    // Save the invoice data
                    $invoice = Invoice::create($invoiceData);

                    // Prepare sender data
                    $senderData = [
                        'date' => $request->date,
                        'sender_name' => $request->invoice_sender_name,
                        'sender_bank_name' => $request->invoice_sender_bank_name,
                        'sender_bank_account' => $request->invoice_sender_bank_account,
                        'tracking_number' => $request->invoice_number,
                        'amount' => $request->invoice_dr_amount_received,
                        'fund_type' => $request->main_category,
                        'sender_detail' => $request->sender_detail,
                        'budget_project_id' => $request->invoice_budget_project_id,
                    ];

                    // Save the sender data
                    Sender::create($senderData);

                    // Create the initial debit ledger entry using 'invoice_dr_amount_received'
                    LedgerEntry::create([
                        'bank_id' => $request->invoice_destination_account,
                        'amount' => abs($request->invoice_dr_amount_received),
                        'type' => 'debit',
                        'budget_project_id' => $request->invoice_budget_project_id,
                        'category_type' => $request->main_category,
                        'description' => 'Invoice Ref: ' . $request->invoice_number, // Adds "Invoice Ref" along with the invoice number
                    ]);

                    // Process and store each item in the ledger as a credit entry
                    foreach ($request->item_description as $index => $description) {
                        $amount = $request->amount[$index] ?? 0;

                        // Only create credit entries from the amounts in the array
                        LedgerEntry::create([
                            'bank_id' => $request->invoice_destination_account,
                            'amount' => abs($amount),
                            'type' => 'credit',
                            'description' => $description,
                            'budget_project_id' => $request->invoice_budget_project_id,
                            'category_type' => $request->main_category,
                        ]);
                    }

                    $this->maintainCashFlow($request->invoice_budget_project_id, $request->invoice_fund_category, $request->invoice_dr_amount_received, 'Received Invoice', $request->invoice_number, $request->date);

                    return redirect()->back()->with('success', 'DPM recorded and cash flow updated.');

                    break;

                case 'Funds Transfer from Management':
                    // return response($request->all());

                    $request->validate([
                        'date_received' => 'required|date',
                        'transfer_reference' => 'required|string|max:255|unique:transfer_from_management,transfer_reference',
                        'fund_category' => 'required|in:Financial,Salary,Facility,Material,Overhead,Capital Expenditure',
                        'source_account' => 'required|numeric',
                        'transfer_amount' => 'required|numeric|min:0',
                        'sender_bank_name' => 'required|string|max:255',
                        'transfer_designation' => 'required|string|max:255',
                        'transfer_date' => 'required|date|before_or_equal:today',
                        'budget_project_id' => 'required|exists:budget_project,id',
                        'transfer_description' => 'nullable|string',
                        'transfer_destination_account' => 'required|numeric',
                    ]);

                    $transferEntry = TransferFromManagement::create([
                        'date_received' => $request->date_received,
                        'transfer_date' => $request->transfer_date,
                        'transfer_designation' => $request->transfer_designation,
                        'transfer_reference' => $request->transfer_reference,
                        'fund_category' => $request->fund_category,
                        'source_account' => $request->source_account,
                        'transfer_destination_account' => $request->transfer_destination_account,
                        'transfer_amount' => $request->transfer_amount,
                        'sender_bank_name' => $request->sender_bank_name,
                        'budget_project_id' => $request->budget_project_id,
                        'transfer_description' => $request->transfer_description ?? '',
                    ]);

                    // Define sender data and save it
                    $senderData = [
                        'date' => $request->date_received,
                        'sender_name' => $request->transfer_designation,
                        'sender_bank_name' => $request->sender_bank_name,
                        'sender_bank_account' => $request->source_account,
                        'tracking_number' => 'TRK #' . $request->transfer_reference,
                        'amount' => $request->transfer_amount,
                        'fund_type' => $request->fund_category,
                        'sender_detail' => $request->transfer_description,
                        'budget_project_id' => $request->budget_project_id,
                    ];

                    Sender::create($senderData);

                    // Create debit and credit ledger entries
                    LedgerEntry::create([
                        'bank_id' => $request->transfer_destination_account,
                        'amount' => abs($request->transfer_amount),
                        'type' => 'debit',
                        'description' => 'Bank Account',
                        'budget_project_id' => $request->budget_project_id,
                        'category_type' => $request->fund_category,
                    ]);

                    LedgerEntry::create([
                        'bank_id' => $request->transfer_destination_account,
                        'amount' => abs($request->transfer_amount),
                        'type' => 'credit',
                        'description' => 'Management Fund For'.' '.$request->fund_category,
                        'budget_project_id' => $request->budget_project_id,
                        'category_type' => $request->fund_category,
                    ]);

                    $this->maintainCashFlow($request->budget_project_id, $request->fund_category, $request->transfer_amount, 'Fund Transfer From Management', $request->transfer_reference, $request->date);

                    return redirect()->back()->with('success', 'DPM recorded and cash flow updated.');


                    break;

                case 'Account Remittance':
                    // Handle account remittance logic
                    break;

                case 'Bank Loan':
                    // Handle bank loan logic
                    break;

                default:
                    // Handle any unexpected cases
                    break;
            }
        } else {
            // Code for handling 'Outflow' fund type
            switch ($mainCategory) {
                case 'Salary':
                    // Handle salary-specific outflow logic
                    break;

                case 'Facility':
                    // Handle facility-specific outflow logic
                    break;

                case 'Material':
                    // Handle material-specific outflow logic
                    break;

                case 'Overhead':
                    // Handle overhead-specific outflow logic
                    break;

                case 'Finance':
                    // Handle finance-specific outflow logic
                    break;

                case 'Capital Expenditure':
                    // Handle capital expenditure-specific outflow logic
                    break;

                default:
                    // Handle any unexpected cases
                    break;
            }
        }
    }

    private function maintainCashFlow($budget_project_id, $category, $amountReceived, $detail, $trackNumber, $date)
    {
        // Fetch the last recorded cash flow for this project and category
        $lastCashFlow = CashFlow::where('budget_project_id', $budget_project_id) // Use parameter
            ->where('category', $category) // Use parameter
            ->orderBy('date', 'desc')
            ->first();

        // Calculate the initial balance
        $balance = $lastCashFlow ? $lastCashFlow->balance : 0;

        // Get the allocated budget for the project and category
        $allocatedBudgetEntry = TotalBudgetAllocated::where('budget_project_id', $budget_project_id)->first();

        if (!$allocatedBudgetEntry) {
            return redirect()
                ->back()
                ->withErrors(['budget_not_found' => 'No allocated budget found for this project.'])
                ->withInput();
        }

        // // Assuming there is a method to get the total allocated budget for the specific category
        $allocatedBudget = $this->getCategoryBudget($allocatedBudgetEntry, $category);

        // dd([
        //     'balance' => $balance,
        //     'amount_received' => $amountReceived
        // ]);

        // Handle cash inflow
        if ($amountReceived > 0) {
            $balance += $amountReceived;
            $this->addCategoryBudget($allocatedBudgetEntry, $category, $amountReceived, $lastCashFlow);
        }

        // // Save the new cash flow entry
        $cashFlow = CashFlow::create([
            'date' => $date,
            'description' => $detail,
            'category' => $category,
            'cash_inflow' => $amountReceived ?? 0.0,
            'cash_outflow' => 0.0,
            'committed_budget' => $lastCashFlow ? $lastCashFlow->committed_budget : 0,
            'balance' => $balance,
            'reference_code' => trim($trackNumber),
            'budget_project_id' => $budget_project_id,
        ]);
    }

    private function handleCashOutFlow()
    {
        // // Handle cash outflow
        // if ($request->cash_outflow > 0) {
        //     if ($request->cash_outflow > $allocatedBudget) {
        //         return redirect()
        //             ->back()
        //             ->withErrors(['insufficient_budget' => "Insufficient funds for {$request->category} cash outflow transaction."])
        //             ->withInput();
        //     }

        //     $balance -= $request->cash_outflow;
        //     $this->deductCategoryBudget($allocatedBudgetEntry, $request->category, $request->cash_outflow, $lastCashFlow);
        // }

        // // Generate a unique reference code
        // $referenceCode = 'DPM' . time();
    }

    private function getCategoryBudget(TotalBudgetAllocated $allocatedBudgetEntry, $category)
    {
        switch ($category) {
            case 'Salary':
                return $allocatedBudgetEntry->total_salary;
            case 'Facility':
                return $allocatedBudgetEntry->total_facility_cost;
            case 'Material':
                return $allocatedBudgetEntry->total_material_cost;
            case 'Overhead':
                return $allocatedBudgetEntry->total_cost_overhead;
            case 'Financial':
                return $allocatedBudgetEntry->total_financial_cost;
            case 'Capital Expenditure':
                return $allocatedBudgetEntry->total_capital_expenditure;
            default:
                return 0; // Or throw an error for an invalid category
        }
    }

    // Helper method to add cash inflow to the corresponding category budget
    private function addCategoryBudget(TotalBudgetAllocated $allocatedBudgetEntry, $category, $cashInflow, $lastCashFlow)
    {
        switch ($category) {
            case 'Salary':
                $allocatedBudgetEntry->total_salary += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance
                break;
            case 'Facility':
                $allocatedBudgetEntry->total_facility_cost += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance
                break;
            case 'Material':
                $allocatedBudgetEntry->total_material_cost += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance
                break;
            case 'Overhead':
                $allocatedBudgetEntry->total_cost_overhead += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance
                break;
            case 'Financial':
                $allocatedBudgetEntry->total_financial_cost += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance

                break;
            case 'Capital Expenditure':
                $allocatedBudgetEntry->total_capital_expenditure += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance
                break;
        }

        // Save the updated allocated budget entry
        $allocatedBudgetEntry->save();
        //save the cash flow
        $lastCashFlow->save();
    }

    // Helper method to add cash Outflow to the corresponding category budget
    private function deductCategoryBudget(TotalBudgetAllocated $allocatedBudgetEntry, $category, $cashOutflow, $lastCashFlow)
    {
        switch ($category) {
            case 'Salary':
                if ($cashOutflow > $allocatedBudgetEntry->total_salary) {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Insufficient salary budget for this cash outflow.']);
                }
                $allocatedBudgetEntry->total_salary -= $cashOutflow;
                $allocatedBudgetEntry->allocated_budget -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;
                break;

            case 'Facility':
                if ($cashOutflow > $allocatedBudgetEntry->total_facility_cost) {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Insufficient facility budget for this cash outflow.']);
                }
                $allocatedBudgetEntry->total_facility_cost -= $cashOutflow;
                $allocatedBudgetEntry->allocated_budget -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;
                break;

            case 'Material':
                if ($cashOutflow > $allocatedBudgetEntry->total_material_cost) {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Insufficient material budget for this cash outflow.']);
                }
                $allocatedBudgetEntry->total_material_cost -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $allocatedBudgetEntry->allocated_budget -= $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;
                break;

            case 'Overhead':
                if ($cashOutflow > $allocatedBudgetEntry->total_cost_overhead) {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Insufficient overhead budget for this cash outflow.']);
                }
                $allocatedBudgetEntry->total_cost_overhead -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $allocatedBudgetEntry->allocated_budget -= $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;
                break;

            case 'Financial':
                if ($cashOutflow > $allocatedBudgetEntry->total_financial_cost) {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Insufficient financial budget for this cash outflow.']);
                }
                $allocatedBudgetEntry->total_financial_cost -= $cashOutflow;
                $allocatedBudgetEntry->allocated_budget -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;
                break;

            case 'Capital Expenditure':
                if ($cashOutflow > $allocatedBudgetEntry->total_capital_expenditure) {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Insufficient capital expenditure budget for this cash outflow.']);
                }
                $allocatedBudgetEntry->total_capital_expenditure -= $cashOutflow;
                $allocatedBudgetEntry->allocated_budget -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;
                break;
        }

        // Proceed with saving or other actions if all checks pass

        // Save the updated allocated budget entry
        $allocatedBudgetEntry->save();
        //save the entry for cash flow
        $lastCashFlow->save();
    }

    public function allocateFund(Request $request)
    {
        // return response()->json($request->all());

        $validatedData = $request->validate([
            'fund_type' => 'required|string',
            'budget_project_id' => 'required|string',
            'amount' => 'required|string',
            'reason' => 'nullable|string',
        ]);

        $amount = $validatedData['amount'];
        $reason = $validatedData['reason'];
        $type = $validatedData['fund_type'];
        $p_id = $validatedData['budget_project_id'];

        $budgetAllocated = TotalBudgetAllocated::where('budget_project_id', $p_id)->first();
        $remainBudget = $budgetAllocated->initial_allocation_budget - $budgetAllocated->allocate_budget;

        $amount = $validatedData['amount']; // Assuming this is your amount
        $remainBudget = $budgetAllocated->initial_allocation_budget - $budgetAllocated->allocate_budget;

        // Check if the amount is less than the remaining budget
        if ($amount < $remainBudget) {
            switch ($type) {
                case 'salary':
                    $allocated = TotalBudgetAllocated::where('budget_project_id', $p_id)->first();
                    $allocated->total_salary += $amount;
                    $allocated->allocated_budget += $amount;
                    $allocated->initial_allocation_budget += $amount;
                    $allocated->save();

                    $cashFlow = CashFlow::where('budget_project_id', $p_id)->where('category', $type)->first();

                    $newcashFlow = new CashFlow();
                    $newcashFlow->category = ucfirst($type);
                    $newcashFlow->description = $reason;
                    $newcashFlow->cash_inflow = $amount;
                    $newcashFlow->cash_outflow = 0;
                    $newcashFlow->balance = $cashFlow->balance + $amount;
                    $newcashFlow->budget_project_id = $p_id;
                    $newcashFlow->reference_code = $cashFlow->reference_code;
                    $newcashFlow->date = now();
                    $newcashFlow->save();
                    return redirect()->back()->with('success', 'Salary Fund Allocated successfully!');
                    break;

                case 'facility':
                    $allocated = TotalBudgetAllocated::where('budget_project_id', $p_id)->first();
                    $allocated->total_facility_cost += $amount;
                    $allocated->allocated_budget += $amount;
                    $allocated->initial_allocation_budget += $amount;
                    $allocated->save();

                    $cashFlow = CashFlow::where('budget_project_id', $p_id)->where('category', $type)->first();

                    $newcashFlow = new CashFlow();
                    $newcashFlow->category = ucfirst($type);
                    $newcashFlow->description = $reason;
                    $newcashFlow->cash_inflow = $amount;
                    $newcashFlow->cash_outflow = 0;
                    $newcashFlow->balance = $cashFlow->balance + $amount;
                    $newcashFlow->budget_project_id = $p_id;
                    $newcashFlow->reference_code = $cashFlow->reference_code;
                    $newcashFlow->date = now();
                    $newcashFlow->save();
                    return redirect()->back()->with('success', 'Facility Fund Allocated successfully!');
                    break;

                case 'material':
                    $allocated = TotalBudgetAllocated::where('budget_project_id', $p_id)->first();
                    $allocated->total_material_cost += $amount;
                    $allocated->allocated_budget += $amount;
                    $allocated->initial_allocation_budget += $amount;
                    $allocated->save();

                    $cashFlow = CashFlow::where('budget_project_id', $p_id)->where('category', $type)->first();

                    $newcashFlow = new CashFlow();
                    $newcashFlow->category = ucfirst($type);
                    $newcashFlow->description = $reason;
                    $newcashFlow->cash_inflow = $amount;
                    $newcashFlow->cash_outflow = 0;
                    $newcashFlow->balance = $cashFlow->balance + $amount;
                    $newcashFlow->budget_project_id = $p_id;
                    $newcashFlow->reference_code = $cashFlow->reference_code;
                    $newcashFlow->date = now();
                    $newcashFlow->save();
                    return redirect()->back()->with('success', 'Material Fund Allocated successfully!');
                    break;

                case 'overhead':
                    $allocated = TotalBudgetAllocated::where('budget_project_id', $p_id)->first();
                    $allocated->total_cost_overhead += $amount;
                    $allocated->allocated_budget += $amount;
                    $allocated->initial_allocation_budget += $amount;
                    $allocated->save();

                    $cashFlow = CashFlow::where('budget_project_id', $p_id)->where('category', $type)->first();

                    $newcashFlow = new CashFlow();
                    $newcashFlow->category = ucfirst($type);
                    $newcashFlow->description = $reason;
                    $newcashFlow->cash_inflow = $amount;
                    $newcashFlow->cash_outflow = 0;
                    $newcashFlow->balance = $cashFlow->balance + $amount;
                    $newcashFlow->budget_project_id = $p_id;
                    $newcashFlow->reference_code = $cashFlow->reference_code;
                    $newcashFlow->date = now();
                    $newcashFlow->save();
                    return redirect()->back()->with('success', 'Overhead Fund Allocated successfully!');
                    break;

                case 'financial':
                    $allocated = TotalBudgetAllocated::where('budget_project_id', $p_id)->first();
                    $allocated->total_financial_cost += $amount;
                    $allocated->allocated_budget += $amount;
                    $allocated->initial_allocation_budget += $amount;
                    $allocated->save();

                    $cashFlow = CashFlow::where('budget_project_id', $p_id)->where('category', $type)->first();

                    $newcashFlow = new CashFlow();
                    $newcashFlow->category = ucfirst($type);
                    $newcashFlow->description = $reason;
                    $newcashFlow->cash_inflow = $amount;
                    $newcashFlow->cash_outflow = 0;
                    $newcashFlow->balance = $cashFlow->balance + $amount;
                    $newcashFlow->budget_project_id = $p_id;
                    $newcashFlow->reference_code = $cashFlow->reference_code;
                    $newcashFlow->date = now();
                    $newcashFlow->save();
                    return redirect()->back()->with('success', 'Financial Fund Allocated successfully!');
                    break;

                case 'Capital Expenditure':
                    $allocated = TotalBudgetAllocated::where('budget_project_id', $p_id)->first();
                    $allocated->total_capital_expenditure += $amount;
                    $allocated->allocated_budget += $amount;
                    $allocated->initial_allocation_budget += $amount;
                    $allocated->save();

                    $cashFlow = CashFlow::where('budget_project_id', $p_id)->where('category', $type)->first();

                    $newcashFlow = new CashFlow();
                    $newcashFlow->category = ucfirst($type);
                    $newcashFlow->description = $reason;
                    $newcashFlow->cash_inflow = $amount;
                    $newcashFlow->cash_outflow = 0;
                    $newcashFlow->balance = $cashFlow->balance + $amount;
                    $newcashFlow->budget_project_id = $p_id;
                    $newcashFlow->reference_code = $cashFlow->reference_code;
                    $newcashFlow->date = now();
                    $newcashFlow->save();

                    return redirect()->back()->with('success', 'Capital Expenditure Fund Allocated successfully!');
                    break;

                default:
                    return response()->json(['error' => 'Invalid type'], 400);
            }
        } else {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Amount exceeds the remaining budget!']);
        }

        return response()->json([
            'message' => 'Funds allocated successfully',
            'updatedAmount' => $updatedAmount,
        ]);
    }
}
