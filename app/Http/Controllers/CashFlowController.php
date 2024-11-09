<?php

namespace App\Http\Controllers;
use App\Models\BudgetProject;
use App\Models\CashFlow;
use App\Models\Bank;
use App\Models\TotalBudgetAllocated;
use Illuminate\Http\Request;

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
        return response($request->all());

        $fundType = $request->fund_type;
        $mainCategory = $request->main_category;
        
        if ($fundType === 'Inflow') {
            switch ($mainCategory) {
                case 'Invoice':
                    $request->validate([
                        'fund_type' => 'required|string',
                        'main_category' => 'required|string',
                        'invoice_number' => 'required|string',
                        'invoice_dr_amount_received' => 'required|numeric',
                        'invoice_budget_project_id' => 'required|integer',
                        'invoice_fund_category' => 'required|string',
                        'invoice_destination_account' => 'required|integer',
                        'item_description' => 'required|array',
                        'item_description.*' => 'string', // each item in the array should be a string
                        'amount' => 'required|array',
                        'amount.*' => 'numeric', // each item in the array should be a numeric value
                    ]);
        
                    $invoiceNumber = $request->invoice_number;
                    $invoiceAmount = $request->invoice_dr_amount_received;
                    $budgetID = $request->invoice_budget_project_id;
                    $fundCategory = $request->invoice_fund_category;
                    $bankID = $request->invoice_destination_account;
                    $items = $request->item_description;
                    $amount = $request->amount;
                    break;
        
                case 'Funds Transfer from Management':
                    // Code to handle funds transfer logic
                    break;
        
                case 'Account Remittance':
                    // Code to handle account remittance logic
                    break;
        
                case 'Bank Loan':
                    // Code to handle bank loan logic
                    break;
        
                default:
                    // Handle any unexpected cases
                    break;
            }
        } else {
            // Code for handling 'Outflow' fund type
            switch ($mainCategory) {
                case 'Salary':
                    // Code to handle salary-specific outflow logic
                    break;
        
                case 'Facility':
                    // Code to handle facility-specific outflow logic
                    break;
        
                case 'Material':
                    // Code to handle material-specific outflow logic
                    break;
        
                case 'Overhead':
                    // Code to handle overhead-specific outflow logic
                    break;
        
                case 'Finance':
                    // Code to handle finance-specific outflow logic
                    break;
        
                case 'Capital Expenditure':
                    // Code to handle capital expenditure-specific outflow logic
                    break;
        
                default:
                    // Handle any unexpected cases
                    break;
            }
        }
        
        // Validate request data
        $request->validate([
            'date' => 'required|date',
            'description' => 'required|string',
            'category' => 'required|string',
            'cash_outflow' => 'nullable|numeric', // Allow null for outflow
            'cash_inflow' => 'nullable|numeric', // Allow null for inflow
            'budget_project_id' => 'required|integer',
        ]);

        // Fetch the last recorded cash flow for this project and category
        $lastCashFlow = CashFlow::where('budget_project_id', $request->budget_project_id)
            ->where('category', $request->category)
            ->orderBy('date', 'desc')
            ->first();

        // Calculate the initial balance
        $balance = $lastCashFlow ? $lastCashFlow->balance : 0;

        // Get the allocated budget for the project and category
        $allocatedBudgetEntry = TotalBudgetAllocated::where('budget_project_id', $request->budget_project_id)->first();

        if (!$allocatedBudgetEntry) {
            return redirect()
                ->back()
                ->withErrors(['budget_not_found' => 'No allocated budget found for this project.'])
                ->withInput();
        }

        // Assuming there is a method to get the total allocated budget for the specific category
        $allocatedBudget = $this->getCategoryBudget($allocatedBudgetEntry, $request->category);

        // Handle cash outflow
        if ($request->cash_outflow > 0) {
            // Check if there's enough budget for the cash outflow
            if ($request->cash_outflow > $allocatedBudget) {
                return redirect()
                    ->back()
                    ->withErrors(['insufficient_budget' => "Insufficient funds for {$request->category} cash outflow transaction."])
                    ->withInput();
            }

            $balance -= $request->cash_outflow;

            $this->deductCategoryBudget($allocatedBudgetEntry, $request->category, $request->cash_outflow, $lastCashFlow);
        }

        // Handle cash inflow
        if ($request->cash_inflow > 0) {
            $balance += $request->cash_inflow; // Add cash inflow to balance
            $this->addCategoryBudget($allocatedBudgetEntry, $request->category, $request->cash_inflow, $lastCashFlow);
        }

        // Generate a unique reference code (e.g., DPM followed by current timestamp)
        $referenceCode = 'DPM' . time();

        // Save the new cash flow entry
        CashFlow::create([
            'date' => $request->date,
            'description' => $request->description,
            'category' => $request->category,
            'cash_inflow' => $request->cash_inflow ?? 0.0, // Ensure cash inflow is recorded
            'cash_outflow' => $request->cash_outflow ?? 0.0, // Ensure cash outflow is recorded
            'committed_budget' => $lastCashFlow ? $lastCashFlow->committed_budget : 0,
            'balance' => $balance,
            'reference_code' => $referenceCode, // Reference code generated dynamically
            'budget_project_id' => $request->budget_project_id,
        ]);

        return redirect()->back()->with('success', 'DPM recorded and cash flow updated.');
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
