<?php

namespace App\Http\Controllers;

use App\Models\BusinessClient;
use App\Models\BudgetProject;
use App\Models\PurchaseOrderSequence;
use App\Models\BusinessUnit;
use App\Models\User;
use App\Models\Project;
use App\Models\Salary;
use App\Models\CashFlow;
use App\Models\Bank;
use App\Models\PurchaseOrder;
use App\Models\ProjectBudgetSequence;
use App\Models\PurchaseOrderController;
use App\Models\FacilityCost;
use App\Models\CapitalExpenditure;
use App\Models\MaterialCost;
use App\Models\CostOverhead;
use App\Models\FinancialCost;
use App\Models\DirectCost;
use App\Models\RevenuePlan;
use App\Models\IndirectCost;
use App\Models\TotalBudgetAllocated;
use Illuminate\Http\Request;
use App\Models\PurchaseOrderItem;
use App\Models\PaymentOrderModel;
use App\Models\SupplierPrice;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentOrder extends Controller
{
    //add payment order
    public function create(Request $request)
    {
        $projects = BudgetProject::all();
        $paymentOrders = PaymentOrderModel::all();
        $users = User::All();
        return view('content.pages.pages-add-budget-project-payment-order', compact('projects', 'paymentOrders', 'users'));
    }

    //store payment order
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'budget_project_id' => 'required|string',
        ]);

        $currentUser = auth()->user();

        // Extract formatted date (DDMMYYYY)
        $formattedDate = Carbon::parse($validated['payment_date'])->format('dmy');

        // Convert payment method to uppercase and replace spaces with dashes
        $formattedMethod = Str::upper(Str::slug($validated['payment_method'], '-'));

        // Generate a random 3-letter string
        $randomLetters = strtoupper(Str::random(3)); // Generate a random string of 3 characters and convert to uppercase

        // Format the method and date
        $formattedMethod = Str::upper(Str::slug($validated['payment_method'], '-'));

        // Generate unique payment order number
        $paymentOrderNumber = "PO{$formattedDate}-{$formattedMethod}-{$randomLetters}";

        // Create the payment order
        $paymentOrder = [
            'payment_order_number' => $paymentOrderNumber,
            'payment_date' => $validated['payment_date'],
            'payment_method' => $validated['payment_method'],
            'budget_project_id' => $validated['budget_project_id'],
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => $currentUser->id,
        ];

        // Save to database (assuming a 'payment_orders' table exists)
        DB::table('payment_orders')->insert($paymentOrder);

        return redirect()->back()->with('success', 'Payment Order is Created Successfully');
    }

    public function show($id)
    {
        $po = PaymentOrderModel::where('payment_order_number', $id)->first();

        if (!$po) {
            return redirect()
                ->back() // Replace 'paymentOrder.index' with your fallback route
                ->withErrors(['error' => 'Payment Order not found.']);
        }

        $budget = BudgetProject::where('id', $po->budget_project_id)->first();
        $project = Project::find($budget->project_id);
        $banks = Bank::all();

        $allocatedBudget = TotalBudgetAllocated::where('budget_project_id', $po->budget_project_id)->first();

        // Return the view with the payment order details
        return view('content.pages.show-budget-project-payment-order', compact('po', 'banks', 'allocatedBudget', 'budget', 'project'));
    }

    //update payment order
    public function update(Request $request)
    {
        // Initial validation for common fields
        $request->validate([
            'payment_order_number' => 'required|string',
            'budget_reference_code' => 'required|string',
            'project_name' => 'required|string',
            'payment_order_method' => 'required|string|in:bank transfer,cash,online transaction,cheque',
            'total_budget' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/', // Match formatted numbers
            'utilization' => 'required|string',
            'balance' => 'required|string',
            'bank_payment_id' => 'required|string',
        ]);

        $paymentMethod = $request->payment_order_method;

        switch ($paymentMethod) {
            case 'bank transfer':
                $request->validate([
                    'beneficiary_name' => 'required|string|max:255',
                    'iban' => 'required|string|max:34', // Max length for IBAN
                    'bank_name' => 'required|string|max:255',
                    'bank_transfer_details' => 'required|string|max:500',
                    'total_bank_transfer' => 'required|string',
                    'item_description' => 'required|array',
                    'item_description.*' => 'string|max:255', // Ensure every item is a valid string
                    'item_amount' => 'required|array',
                    'item_amount.*' => [
                        'required',
                        'regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/', // Allow numbers with commas
                    ],
                ]);

                $request->merge([
                    'total_budget' => str_replace(',', '', $request->total_budget),
                    'utilization' => str_replace(',', '', $request->utilization),
                    'balance' => str_replace(',', '', $request->balance),
                    'item_amount' => array_map(function ($amount) {
                        return str_replace(',', '', $amount);
                    }, $request->item_amount),
                    'total_bank_transfer' => str_replace(',', '', $request->total_bank_transfer),
                ]);

                $totalAmount = (float) $request->total_bank_transfer;

                $bankTransferData = [
                    'payment_order_number' => $request->payment_order_number,
                    'budget_reference_code' => $request->budget_reference_code,
                    'payment_order_method' => $request->payment_order_method,
                    'beneficiary_name' => $request->beneficiary_name,
                    'total_bank_transfer' => $totalAmount,
                    'iban' => $request->iban,
                    'bank_name' => $request->bank_name,
                    'bank_transfer_details' => $request->bank_transfer_details,
                    'total_budget' => $request->total_budget,
                    'utilization' => $request->utilization,
                    'balance' => $request->balance,
                    'bank_payment_id' => $request->bank_payment_id,
                    'item_description' => json_encode($request->item_description),
                    'item_amount' => json_encode($request->item_amount),
                    'submit_status' => 'Submitted',
                ];

                // Find existing payment order
                $paymentOrder = PaymentOrderModel::where('payment_order_number', $request->payment_order_number)->first();

                if ($paymentOrder) {
                    // Attempt to update the record
                    try {
                        $paymentOrder->update($bankTransferData);
                        return redirect()->back()->with('success', 'Payment Order updated successfully!');
                    } catch (\Exception $e) {
                        \Log::error('Failed to update Payment Order', ['error' => $e->getMessage()]);
                        return redirect()
                            ->back()
                            ->withErrors(['error' => 'Failed to update Payment Order.']);
                    }
                } else {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Payment Order not found.']);
                }

                break;
            case 'cash':
                // return response($request->all());
                // Preprocess numeric fields to remove commas
                $request->merge([
                    'cash_amount' => str_replace(',', '', $request->cash_amount),
                    'total_budget' => str_replace(',', '', $request->total_budget),
                    'utilization' => str_replace(',', '', $request->utilization),
                    'balance' => str_replace(',', '', $request->balance),
                    'item_amount' => array_map(function ($amount) {
                        return str_replace(',', '', $amount);
                    }, $request->item_amount),
                ]);

                // Validate the request for cash payment
                $request->validate([
                    'cash_received_by' => 'required|string|max:255',
                    'cash_date' => 'required|date',
                    'item_description' => 'required|array',
                    'item_description.*' => 'string|max:255',
                    'cash_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Ensure valid decimal
                    'cash_detail' => 'nullable|string|max:500',
                    'item_amount' => 'required|array',
                    'item_amount.*' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Validate decimals
                    'total_budget' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Validate decimals
                    'utilization' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Validate decimals
                    'balance' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Validate decimals
                    'bank_payment_id' => 'required|integer|exists:banks,id', // Ensure valid bank ID
                ]);

                // Process fields for decimal values
                $cashAmount = (float) $request->cash_amount; // Already preprocessed
                $itemAmounts = array_map('floatval', $request->item_amount); // Convert to decimals
                $totalBudget = (float) $request->total_budget;
                $utilization = (float) $request->utilization;
                $balance = (float) $request->balance;

                // Build the cashData array
                $cashData = [
                    'payment_order_number' => $request->payment_order_number,
                    'budget_reference_code' => $request->budget_reference_code,
                    'project_name' => $request->project_name,
                    'payment_order_method' => $request->payment_order_method,
                    'cash_received_by' => $request->cash_received_by,
                    'cash_date' => $request->cash_date,
                    'cash_amount' => $cashAmount, // Decimal value
                    'cash_detail' => $request->cash_detail,
                    'total_budget' => $totalBudget, // Decimal value
                    'utilization' => $utilization, // Decimal value
                    'balance' => $balance, // Decimal value
                    'bank_payment_id' => $request->bank_payment_id,
                    'item_description' => json_encode($request->item_description), // Keep as is
                    'item_amount' => json_encode($request->item_amount), // Processed array
                    'item_status' => $request->item_status, // Keep as is
                    'submit_status' => 'Submitted',
                ];

                // Find existing payment order
                $paymentOrder = PaymentOrderModel::where('payment_order_number', $request->payment_order_number)->first();

                if ($paymentOrder) {
                    // Log data before update
                    \Log::info('Updating Payment Order', ['cashData' => $cashData, 'paymentOrder' => $paymentOrder]);

                    // Attempt to update the record
                    try {
                        $paymentOrder->update($cashData);
                        return redirect()->back()->with('success', 'Payment Order updated successfully!');
                    } catch (\Exception $e) {
                        \Log::error('Failed to update Payment Order', ['error' => $e->getMessage()]);
                        return redirect()
                            ->back()
                            ->withErrors(['error' => 'Failed to update Payment Order.']);
                    }
                } else {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Payment Order not found.']);
                }

                break;

            case 'online transaction':
                $request->validate([
                    'transaction_number' => 'required|string|max:255',
                    'transaction_detail' => 'required|string|max:255',
                    'transaction_amount' => 'required|string', // Ensure valid decimal
                    'item_description' => 'required|array',
                    'item_description.*' => 'string|max:255', // Ensure every item is a valid string
                    'item_amount' => 'required|array',
                    'item_amount.*' => [
                        'required',
                        'regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/', // Allow numbers with commas
                    ],
                ]);

                $request->merge([
                    'total_budget' => str_replace(',', '', $request->total_budget),
                    'utilization' => str_replace(',', '', $request->utilization),
                    'balance' => str_replace(',', '', $request->balance),
                    'item_amount' => array_map(function ($amount) {
                        return str_replace(',', '', $amount);
                    }, $request->item_amount),
                    'transaction_amount' => str_replace(',', '', $request->transaction_amount),
                ]);

                $transactionAmount = (float) $request->transaction_amount; // Already preprocessed

                // Find existing payment order
                $paymentOrder = PaymentOrderModel::where('payment_order_number', $request->payment_order_number)->first();

                if ($paymentOrder) {
                    // Prepare the data for update
                    $onlineTransactionData = [
                        'transaction_number' => $request->transaction_number,
                        'transaction_detail' => $request->transaction_detail,
                        'budget_reference_code' => $request->budget_reference_code,
                        'payment_order_method' => $request->payment_order_method,
                        'total_budget' => str_replace(',', '', $request->total_budget),
                        'utilization' => str_replace(',', '', $request->utilization),
                        'balance' => str_replace(',', '', $request->balance),
                        'bank_payment_id' => $request->bank_payment_id,
                        'item_description' => json_encode($request->item_description), // Keep as JSON
                        'item_amount' => json_encode($request->item_amount), // Keep as JSON
                        'submit_status' => 'Submitted',
                        'transaction_amount' => $transactionAmount,
                    ];

                    try {
                        $paymentOrder->update($onlineTransactionData);
                        return redirect()->back()->with('success', 'Payment Order updated successfully!');
                    } catch (\Exception $e) {
                        \Log::error('Failed to update Payment Order', ['error' => $e->getMessage()]);
                        return redirect()
                            ->back()
                            ->withErrors(['error' => 'Failed to update Payment Order.']);
                    }
                } else {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Payment Order not found.']);
                }

                break;

            case 'cheque':
                // Preprocess the request data
                $request->merge([
                    'total_cheque_amount' => str_replace(',', '', $request->total_cheque_amount),
                    'total_budget' => str_replace(',', '', $request->total_budget),
                    'utilization' => str_replace(',', '', $request->utilization),
                    'balance' => str_replace(',', '', $request->balance),
                    'item_amount' => array_map(function ($amount) {
                        return str_replace(',', '', $amount);
                    }, $request->item_amount ?? []), // Ensure this handles null gracefully
                ]);

                // Validate the request inputs
                $validatedData = $request->validate([
                    'cheque_number' => 'required|string|max:50',
                    'cheque_date' => 'required|date',
                    'cheque_file' => 'required|file|mimes:pdf|max:2048', // Ensure the uploaded file is a PDF
                    'total_cheque_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Allow valid decimal format
                    'cheque_payee' => 'required|string|max:255',
                    'item_description' => 'required|array', // Ensure item descriptions are an array
                    'item_description.*' => 'string|max:255', // Each item must be a string
                    'item_amount' => 'required|array', // Ensure item amounts are an array
                    'item_amount.*' => 'regex:/^\d+(\.\d{1,2})?$/', // Allow numbers with decimals
                ]);

                // Calculate the cheque amount
                $chequeAmount = (float) $request->total_cheque_amount;

                $paymentOrder = PaymentOrderModel::where('payment_order_number', $request->payment_order_number)->first();

                if ($paymentOrder) {
                    // Prepare data for storage or further processing
                    $chequeData = [
                        'payment_order_number' => $request->payment_order_number,
                        'budget_reference_code' => $request->budget_reference_code,
                        'project_name' => $request->project_name,
                        'payment_method' => $request->payment_order_method,
                        'cheque_number' => $request->cheque_number,
                        'total_cheque_amount' => $chequeAmount,
                        'cheque_date' => $request->cheque_date,
                        'cheque_payee' => $request->cheque_payee,
                        'total_budget' => (float) $request->total_budget,
                        'utilization' => (float) $request->utilization,
                        'balance' => (float) $request->balance,
                        'bank_payment_id' => $request->bank_payment_id,
                        'item_description' => json_encode($request->item_description),
                        'item_amount' => json_encode($request->item_amount),
                        'submit_status' => 'Submitted',
                    ];

                    // Handle file upload if it exists
                    if ($request->hasFile('cheque_file')) {
                        $file = $request->file('cheque_file');
                        $extension = $file->getClientOriginalExtension();

                        $filename = time() . '.' . $extension;
                        $file->move('public/cheque/', $filename);
                        $path = 'public/cheque/' . $filename;

                        $chequeData['cheque_file'] = $path;
                    }

                    try {
                        $paymentOrder->update($chequeData);
                        return redirect()->back()->with('success', 'Payment Order updated successfully!');
                    } catch (\Exception $e) {
                        \Log::error('Failed to update Payment Order', ['error' => $e->getMessage()]);
                        return redirect()
                            ->back()
                            ->withErrors(['error' => 'Failed to update Payment Order.']);
                    }
                } else {
                    return redirect()
                        ->back()
                        ->withErrors(['error' => 'Payment Order not found.']);
                }

                break;

            default:
                return response()->json(['error' => 'Invalid payment method'], 400);
        }

        return redirect()->back()->with('success', 'Payment order recorded successfully!');
    }

    //payment order list
    public function list(Request $request)
    {
        $projects = BudgetProject::all();
        $paymentOrders = PaymentOrderModel::all();
        $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
        $budgetList = BudgetProject::get();
        $userList = User::get();
        $query = PaymentOrderModel::query();

        $totalBudgetAllocated = TotalBudgetAllocated::all();

        // Apply filters
        if ($request->has('project_id') && $request->project_id != '') {
            $query->where('budget_project_id', $request->project_id);
        }

        if ($request->has('payment_order_id') && $request->payment_order_id != '') {
            $query->where('id', $request->payment_order_id);
        }

        if ($request->has('po_number') && $request->po_number != '') {
            $query->where('payment_order_number', 'like', '%' . $request->po_number . '%');
        }

        if ($request->has('project_reference') && $request->project_reference != '') {
            // Fetch the project with the given reference code
            $project = BudgetProject::where('reference_code', 'like', '%' . $request->project_reference . '%')->first();

            if ($project) {
                // Filter payment orders by the project's ID
                $query->where('budget_project_id', $project->id);
            } else {
                // If no project is found, return an empty result
                $query->whereRaw('0 = 1'); // This ensures no records are returned
            }
        }

        $filteredPaymentOrders = $query->get(); // Fetch filtered Payment Orders

        return view('content.pages.pages-show-paymentorder-list', compact('filteredPaymentOrders', 'projects', 'users', 'userList', 'budgetList', 'totalBudgetAllocated', 'paymentOrders'));
    }

    //payment order delete
    public function destroy($id)
    {
        // Find the payment order by ID
        $paymentOrder = PaymentOrderModel::where('payment_order_number', $id)->first();
        if (!$paymentOrder) {
            return redirect()->back()->with('error', 'Payment order not found.');
        }

        try {
            // Delete the payment order
            $paymentOrder->delete();
            return redirect()->back()->with('success', 'Payment order deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the payment order.');
        }
    }
}
