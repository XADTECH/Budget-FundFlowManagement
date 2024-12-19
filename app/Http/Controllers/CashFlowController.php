<?php

namespace App\Http\Controllers;

use App\Models\BudgetProject;
use App\Models\CashFlow;
use App\Models\Bank;
use App\Models\Loan;
use App\Models\Invoice;
use App\Models\Sender;
use App\Models\LedgerEntry;
use App\Models\BankBalance;
use App\Models\TotalBudgetAllocated;
use App\Models\RemittanceTransfer;
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
                        $extension = $file->getClientOriginalExtension();

                        $filename = time() . '.' . $extension;
                        $file->move('public/invoices/', $filename);
                        $path = 'public/invoices/' . $filename;

                        $invoiceData['invoice_file'] = $path;
                    }

                    // Save the invoice data
                    $invoice = Invoice::create($invoiceData);

                    // Prepare sender data
                    $senderData = [
                        'date' => $request->date,
                        'sender_for' => 'Invoice',
                        'sender_name' => $request->invoice_sender_name,
                        'sender_bank_name' => $request->invoice_sender_bank_name,
                        'sender_bank_account' => $request->invoice_sender_bank_account,
                        'tracking_number' => $request->invoice_number,
                        'amount' => $request->invoice_dr_amount_received,
                        'fund_type' => $request->invoice_fund_category,
                        'sender_detail' => $request->sender_detail,
                        'budget_project_id' => $request->invoice_budget_project_id,
                        'destination_account' => $request->invoice_destination_account,
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
                        'description' => 'Invoice Ref: ' . $request->invoice_number,
                    ]);

                    // Process and store each item in the ledger as a credit entry
                    foreach ($request->item_description as $index => $description) {
                        $amount = $request->amount[$index] ?? 0;

                        LedgerEntry::create([
                            'bank_id' => $request->invoice_destination_account,
                            'amount' => abs($amount),
                            'type' => 'credit',
                            'description' => $description,
                            'budget_project_id' => $request->invoice_budget_project_id,
                            'category_type' => $request->main_category,
                        ]);
                    }

                    // Update balances
                    $this->updateOverallBankBalance($request->invoice_destination_account, $request->invoice_dr_amount_received, 'debit');
                    $this->updateProjectBankBalance($request->invoice_destination_account, $request->invoice_budget_project_id, $request->invoice_dr_amount_received, 'debit');

                    // Update cash flow
                    $this->maintainCashFlow($request->invoice_budget_project_id, $request->invoice_fund_category, $request->invoice_dr_amount_received, 'Received Invoice', $request->invoice_number, $request->date);

                    return redirect()->back()->with('success', 'Invoice recorded and cash flow updated.');
                    break;

                case 'Funds Transfer from Management':
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
                        'sender_for' => 'Funds Transfer From Management',
                        'sender_name' => $request->transfer_designation,
                        'sender_bank_name' => $request->sender_bank_name,
                        'sender_bank_account' => $request->source_account,
                        'tracking_number' => 'TRK #' . $request->transfer_reference,
                        'amount' => $request->transfer_amount,
                        'fund_type' => $request->fund_category,
                        'sender_detail' => $request->transfer_description,
                        'budget_project_id' => $request->budget_project_id,
                        'destination_account' => $request->transfer_destination_account,
                    ];

                    Sender::create($senderData);

                    // Create debit and credit ledger entries
                    LedgerEntry::create([
                        'bank_id' => $request->transfer_destination_account,
                        'amount' => abs($request->transfer_amount),
                        'type' => 'debit',
                        'description' => 'Bank Account (Bank Transfer) - Ref : ' . $request->transfer_reference,
                        'budget_project_id' => $request->budget_project_id,
                        'category_type' => $request->fund_category,
                    ]);

                    LedgerEntry::create([
                        'bank_id' => $request->transfer_destination_account,
                        'amount' => abs($request->transfer_amount),
                        'type' => 'credit',
                        'description' => 'Management Fund For ' . $request->fund_category,
                        'budget_project_id' => $request->budget_project_id,
                        'category_type' => $request->fund_category,
                    ]);

                    // Update balances
                    $this->updateOverallBankBalance($request->transfer_destination_account, $request->transfer_amount, 'debit');
                    $this->updateProjectBankBalance($request->transfer_destination_account, $request->budget_project_id, $request->transfer_amount, 'debit');

                    // Update cash flow
                    $this->maintainCashFlow($request->budget_project_id, $request->fund_category, $request->transfer_amount, 'Fund Transfer From Management', $request->transfer_reference, $request->date);

                    return redirect()->back()->with('success', 'Funds Transfer recorded and cash flow updated.');
                    break;

                case 'Account Remittance':
                    $request->merge([
                        'remittance_amount' => str_replace(',', '', $request->input('remittance_amount')), // Remove commas for numeric validation
                    ]);

                    $request->validate([
                        'remittance_reference' => 'required|string|max:255|unique:remittance_transfers,remittance_reference',
                        'remittance_payer_name' => 'required|string|max:255',
                        'remittance_amount' => 'required|numeric|min:0',
                        'remittance_sender_bank' => 'required|string|max:255',
                        'remittance_account_number' => 'required|string|max:255',
                        'remittance_destination_account' => 'required|integer|exists:banks,id',
                        'fund_category' => 'required|string|in:Financial,Salary,Facility,Material,Overhead,Capital Expenditure',
                        'budget_project_id' => 'required|integer|exists:budget_project,id',
                        'remittance_date_received' => 'required|date',
                        'remittance_currency' => 'required|string|max:10',
                        'remittance_description' => 'nullable|string|max:1000',
                    ]);

                    RemittanceTransfer::create([
                        'remittance_reference' => $request->remittance_reference,
                        'remittance_payer_name' => $request->remittance_payer_name,
                        'remittance_amount' => $request->remittance_amount,
                        'remittance_sender_bank' => $request->remittance_sender_bank,
                        'remittance_account_number' => $request->remittance_account_number,
                        'remittance_destination_account' => $request->remittance_destination_account,
                        'fund_category' => $request->fund_category,
                        'budget_project_id' => $request->budget_project_id,
                        'remittance_date_received' => $request->remittance_date_received,
                        'remittance_currency' => $request->remittance_currency,
                        'remittance_description' => $request->remittance_description,
                    ]);

                    LedgerEntry::create([
                        'bank_id' => $request->remittance_destination_account,
                        'amount' => abs($request->remittance_amount),
                        'type' => 'debit',
                        'description' => 'Remittance Ref: ' . $request->remittance_reference,
                        'budget_project_id' => $request->budget_project_id,
                        'category_type' => $request->fund_category,
                    ]);

                    $senderData = [
                        'date' => $request->remittance_date_received,
                        'sender_for' => 'Account Remittance',
                        'sender_name' => $request->remittance_payer_name, // Assuming sender is payer
                        'sender_bank_name' => $request->remittance_sender_bank,
                        'sender_bank_account' => $request->remittance_account_number,
                        'tracking_number' => 'Remit #' . $request->remittance_reference,
                        'amount' => $request->remittance_amount,
                        'fund_type' => $request->fund_category,
                        'sender_detail' => $request->remittance_description,
                        'budget_project_id' => $request->budget_project_id,
                        'destination_account' => $request->remittance_destination_account,
                    ];

                    Sender::create($senderData);

                    $this->updateOverallBankBalance($request->remittance_destination_account, $request->remittance_amount, 'debit');
                    $this->updateProjectBankBalance($request->remittance_destination_account, $request->budget_project_id, $request->remittance_amount, 'debit');
                    $this->maintainCashFlow($request->budget_project_id, $request->fund_category, $request->remittance_amount, 'Account Remittance', $request->remittance_reference, $request->date);

                    return redirect()->back()->with('success', 'Account remittance recorded and cash flow updated.');
                    break;

                case 'Bank Loan':
                    // return response($request->all());
                    $validatedData = $request->validate([
                        'loan_reference' => 'required|string|max:255|unique:loans,loan_reference',
                        'loan_provider_type' => 'required|string|max:50', // e.g., 'bank', 'director'
                        'loan_provider_name' => 'required|string|max:255',
                        'loan_amount' => 'required|numeric|min:0',
                        'loan_interest_rate' => 'nullable|numeric|min:0|max:100',
                        'loan_bank_account' => 'required|string|max:50',
                        'fund_category' => 'required|string|in:Financial,Overhead,Salary,Facility,Material',
                        'loan_repayment_start_date' => 'nullable|date',
                        'loan_repayment_frequency' => 'required|string|in:Monthly,Quarterly,Annually',
                        'loan_destination_account' => 'nullable|exists:banks,id',
                        'budget_project_id' => 'nullable|exists:budget_project,id',
                        'loan_date' => 'required|date',
                        'loan_description' => 'nullable|string|max:1000',
                    ]);

                    Loan::create($validatedData);

                    // Create debit ledger entry for the principal loan amount received
                    $interestAmount = $request->loan_amount * ($request->loan_interest_rate / 100);

                    $loanData = [
                        'date' => $request->loan_date,
                        'sender_for' => 'Bank Loan', // Reflect the purpose as a loan
                        'sender_name' => $request->loan_provider_name, // Loan provider name
                        'sender_bank_name' => $request->loan_provider_name, // Assuming the loan provider is the sender bank
                        'sender_bank_account' => $request->loan_bank_account,
                        'tracking_number' => 'Loan Ref #' . $request->loan_reference, // Unique loan reference number
                        'amount' => abs($request->loan_amount + $interestAmount),
                        'fund_type' => $request->fund_category, // Fund category (e.g., Finance)
                        'sender_detail' => $request->loan_description, // Loan purpose or description
                        'budget_project_id' => $request->budget_project_id, // Associated budget project
                        'destination_account' => $request->loan_destination_account, // Destination bank account ID
                    ];

                    Sender::create($loanData);

                    LedgerEntry::create([
                        'bank_id' => $request->loan_destination_account, // Destination bank account ID
                        'amount' => abs($request->loan_amount + $interestAmount), // Debit the loan amount received
                        'type' => 'debit',
                        'description' => 'Bank Loan - Ref: ' . $request->loan_reference,
                        'budget_project_id' => $request->budget_project_id, // Associated budget project
                        'category_type' => $request->fund_category, // Fund category (e.g., Finance)
                        'transaction_date' => $request->loan_date, // Loan date
                    ]);

                    // Optionally, create a credit ledger entry for the interest liability
                    if (!empty($request->loan_interest_rate)) {
                        $interestAmount = $request->loan_amount * ($request->loan_interest_rate / 100);

                        LedgerEntry::create([
                            'bank_id' => $request->loan_destination_account, // Destination bank account ID
                            'amount' => abs($interestAmount), // Credit the interest amount
                            'type' => 'credit',
                            'description' => 'Loan Interest Liability - Ref: ' . $request->loan_reference,
                            'budget_project_id' => $request->budget_project_id, // Associated budget project
                            'category_type' => $request->fund_category, // Fund category (e.g., Finance)
                            'transaction_date' => $request->loan_date, // Loan date
                        ]);

                        LedgerEntry::create([
                            'bank_id' => $request->loan_destination_account, // Destination bank account ID
                            'amount' => abs($request->loan_amount), // Credit the interest amount
                            'type' => 'credit',
                            'description' => 'Bank Loan Principle Amount - Ref: ' . $request->loan_reference,
                            'budget_project_id' => $request->budget_project_id, // Associated budget project
                            'category_type' => $request->fund_category, // Fund category (e.g., Finance)
                            'transaction_date' => $request->loan_date, // Loan date
                        ]);
                    }

                    $this->updateOverallBankBalance($request->loan_destination_account, $request->loan_amount, 'debit');
                    $this->updateProjectBankBalance($request->loan_destination_account, $request->budget_project_id, $request->loan_amount, 'debit');
                    $this->maintainCashFlow($request->budget_project_id, $request->fund_category, $request->loan_amount, 'Bank Loan', $request->loan_reference, $request->date);

                    // Update cash flow for loan
                    $this->maintainCashFlow(
                        $request->budget_project_id, // The associated budget project ID
                        $request->fund_category, // The fund category (e.g., Finance)
                        abs($request->loan_amount), // Ensure the amount is positive
                        'Bank Loan', // Description updated to reflect loan type
                        $request->loan_reference, // The unique loan reference
                        $request->loan_date, // Loan date
                    );

                    return redirect()->back()->with('success', 'Loan Received and Record Saved Successfully !');

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

    private function updateOverallBankBalance($bankId, $amount, $type)
    {
        $bank = Bank::findOrFail($bankId);
        if ($type === 'debit') {
            $bank->current_balance += $amount;
        } elseif ($type === 'credit') {
            $bank->current_balance -= $amount;
        }
        $bank->save();
    }

    /**
     * Update project-specific bank balance in the `bank_balances` table.
     */
    private function updateProjectBankBalance($bankId, $projectId, $amount, $type)
    {
        $bankBalance = BankBalance::firstOrNew([
            'bank_id' => $bankId,
            'budget_project_id' => $projectId,
        ]);

        if ($type === 'debit') {
            $bankBalance->current_balance += $amount;
        } elseif ($type === 'credit') {
            $bankBalance->current_balance -= $amount;
        }

        $bankBalance->save();
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

        $allocatedBudget = $this->getCategoryBudget($allocatedBudgetEntry, $category);

        // Handle cash inflow
        if ($amountReceived > 0) {
            $balance += $amountReceived;
            $allocatedBudgetEntry->remaining_fund += $amountReceived;;
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
