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
use App\Models\PurchaseOrder;
use App\Models\ProjectBudgetSequence;
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
use App\Models\SupplierPrice;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class PurcahseOrderController extends Controller
{
    //add / show purchase order
    public function addPurchaseOrder(Request $request)
    {
        $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);

        $projects = BudgetProject::all();
        $loggedInUserId = Auth::id();
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Finance Manager') {
            $purchaseOrders = PurchaseOrder::all();
        } else {
            $purchaseOrders = PurchaseOrder::where('prepared_by', $loggedInUserId)->get();
        }

        // Retrieve budgets where manager_id matches the logged-in user ID
        $budgets = BudgetProject::where('manager_id', $loggedInUserId)->get();
        $budgetList = BudgetProject::get();
        $userList = User::get();
        $supplierlist = SupplierPrice::get();

        return view('content.pages.pages-add-project-budget-purchase-order', compact('supplierlist', 'budgets', 'purchaseOrders', 'users', 'userList', 'budgetList', 'projects'));
    }

    //add / show purchase order
    public function storePurchaseOrder(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'startdate' => 'required|date',
                'payment_term' => 'required|string|max:255',
                'supplier_name' => 'nullable|string|max:255',
                'supplier_address' => 'nullable|string|max:255',
                'project_name' => 'nullable|integer',
                'description' => 'nullable|string',
                'project_person_id' => 'nullable|integer', // Use 'integer' or 'numeric'
            ]);

            // Check if allocated budget exists
            $allocatedBudgetExists = TotalBudgetAllocated::where('budget_project_id', $request->project_name)->exists();

            if (!$allocatedBudgetExists) {
                // Return back with error if the budget is not allocated
                return redirect()
                    ->back()
                    ->withErrors(['budget' => 'Budget is Not Allocated']);
            }

            $currentDate = Carbon::now();
            $monthName = $currentDate->format('M'); // Short month name (e.g. Jan, Feb)
            $year = $currentDate->format('Y'); // Full year (e.g. 2024)
            $formattedMonthYear = strtoupper($monthName . $year); // E.g. JAN2024

            // // Get current date in the desired format (MMDDYYYY)
            // $formattedDate = $currentDate->format('mdY'); // E.g. 09062024

            // // Fetch the current sequence for the date or create a new one
            // $poSequence = PurchaseOrderSequence::firstOrCreate(['date' => $formattedDate], ['last_sequence' => 0]);

            // // Increment the sequence number
            // $newSerialNumber = str_pad($poSequence->last_sequence + 1, 4, '0', STR_PAD_LEFT);

            // // Update the last sequence in the database
            // $poSequence->last_sequence = $newSerialNumber;
            // $poSequence->save();
            $uniqueDigits = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT); // Generate a 4-digit number with leading zeros if necessary
            $referenceCode = 'PO' . $uniqueDigits;

            // Create a new PurchaseOrder instance
            $purchaseOrder = new PurchaseOrder();

            // Set attributes from validated data
            $purchaseOrder->date = $validatedData['startdate'];
            $purchaseOrder->payment_term = $validatedData['payment_term'];
            $purchaseOrder->supplier_name = $validatedData['supplier_name'];
            $purchaseOrder->supplier_address = $validatedData['supplier_address'];
            $purchaseOrder->description = $validatedData['description'];
            $purchaseOrder->po_number = $referenceCode;
            $purchaseOrder->project_id = $request->project_name;
            $purchaseOrder->requested_by = $validatedData['project_person_id'];
            $purchaseOrder->prepared_by = Auth::id();
            $purchaseOrder->save();

            // Return a success response
            return redirect('/pages/add-budget-project-purchase-order')->with('success', 'PO Created successfully!');
        } catch (\Exception $e) {
            // Return back with an error message
            return redirect()
                ->back()
                ->withErrors(['error' => 'An error occurred while creating the Purchase Order: ' . $e->getMessage()]);
        }
    }

    //save purchase order item
    public function editPurchaseOrder($POID)
    {
        // Fetching the Purchase Order
        $purchaseOrder = PurchaseOrder::where('po_number', $POID)->first();

        // Fetch salary, facility, and material budgets using nullable operator
        $totalBudgetAllocated = TotalBudgetAllocated::where('budget_project_id', $purchaseOrder->project_id)->first();

        // Check if purchase order exists before proceeding
        if (!$purchaseOrder) {
            return redirect('/pages/add-budget-project-purchase-order')->withErrors(['error' => 'Purchase Order not found!']);
        }

        if (!$totalBudgetAllocated) {
            return redirect('/pages/add-budget-project-purchase-order')->withErrors(['error' => 'Budget is Not Allocated For this Project']);
        }

        // Fetching related data using relationships and first()
        $budget = BudgetProject::where('id', $purchaseOrder->project_id)->first();
        $clients = BusinessClient::where('id', $budget->client_id)->first(); // fetching client details
        $units = BusinessUnit::where('id', $budget->unit_id)->first(); // fetching unit details
        $budgets = Project::where('id', $budget->project_id)->first(); // fetching project details
        $requested = User::where('id', $purchaseOrder->requested_by)->first(); // fetching user who requested
        $prepared = User::where('id', $purchaseOrder->prepared_by)->first(); // fetching user who prepared

        // Retrieve utilization and budget details
        $utilization = $budget->getUtilization();
        $poStatus = $purchaseOrder->status;

        // Fetch materials, salaries, facilities, and capital expenses
        $materials = MaterialCost::where('budget_project_id', $purchaseOrder->project_id)->get();
        $salaries = Salary::where('budget_project_id', $purchaseOrder->project_id)->get();
        $facilities = FacilityCost::where('budget_project_id', $purchaseOrder->project_id)->get();
        $capitalExpenses = CapitalExpenditure::where('budget_project_id', $purchaseOrder->project_id)->get();
        $financial = FinancialCost::where('budget_project_id', $purchaseOrder->project_id)->get();

        // Calculate budget utilization details
        $balanceBudget = $budget->getRemainingBudget();

        $salaryBudget = $totalBudgetAllocated?->committed_allocated_salary;
        $facilityBudget = $totalBudgetAllocated?->committed_allocated_facility_cost;
        $materialBudget = $totalBudgetAllocated?->committed_allocated_material_cost;
        $capitalExpensesTotal = $totalBudgetAllocated?->committed_allocated_capital_expenditure;
        $financialBudget = $totalBudgetAllocated?->committed_allocated_financial_cost;
        $costOverheadBudget = $totalBudgetAllocated?->committed_allocated_cost_overhead;
        $totalBudget = $totalBudgetAllocated?->allocated_budget;

        // Fetch capital expenditures (as a collection)
        $capitalExpensesTotal = TotalBudgetAllocated::where('budget_project_id', $purchaseOrder->project_id)->pluck('total_capital_expenditure');

        // Returning the view with compact data
        return view('content.pages.show-budget-project-purchase-order', compact('purchaseOrder', 'capitalExpensesTotal', 'salaryBudget', 'facilityBudget', 'materialBudget', 'financialBudget', 'capitalExpenses', 'budget', 'clients', 'units', 'budgets', 'requested', 'prepared', 'utilization', 'balanceBudget', 'poStatus', 'materials', 'financial', 'salaries', 'facilities', 'totalBudget'));
    }

    //save purchase order & store purchase order item

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'poNumber' => 'required|string',
                'items' => 'required|array', // Validate that items are an array
                'totalAmount' => 'required|numeric',
                'totalDiscount' => 'required|numeric',
                'totalVAT' => 'required|numeric',
            ]);

            // Fetch the purchase order ID using poNumber
            $purchaseOrder = PurchaseOrder::where('po_number', $request->poNumber)->firstOrFail();

            // Append total discount and VAT to each item
            $items = $request->items;
            foreach ($items as &$item) {
                $item['totalDiscount'] = $request->totalDiscount; // Add total discount
                $item['totalVAT'] = $request->totalVAT; // Add total VAT
            }

            // Encode the modified items as JSON
            $encodedItems = json_encode($items);

            return response($encodedItems);

            // Update purchase order details
            $purchaseOrder->subtotal = $request->totalAmount;
            $purchaseOrder->vat = $request->totalVAT;
            $purchaseOrder->total_discount = $request->totalDiscount;

            // Process each item and update the budget
            foreach ($encodedItems as $item) {
                $budget = TotalBudgetAllocated::where('budget_project_id', $item['b_id'])->first();

                if ($budget) {
                    switch ($item['category']) {
                        case 'salary':
                            $budget->committed_allocated_salary -= $item['itemTotal'];
                            break;
                        case 'material':
                            $budget->committed_allocated_material_cost -= $item['itemTotal'];
                            break;
                        case 'facilities':
                            $budget->committed_allocated_facility_cost -= $item['itemTotal'];
                            break;
                        case 'capital_expenses':
                            $budget->committed_allocated_capital_expenditure -= $item['itemTotal'];
                            break;
                        case 'financial':
                            $budget->committed_allocated_financial_cost -= $item['itemTotal'];
                            break;
                        case 'overhead':
                            $budget->committed_allocated_cost_overhead -= $item['itemTotal'];
                            break;
                    }
                    $budget->committed_remaining_fund -= $item['itemTotal'];
                    $budget->save();
                }
            }

            // Save the purchase order items
            $poItems = PurchaseOrderItem::create([
                'purchase_order_id' => $purchaseOrder->id,
                'po_number' => $request->poNumber,
                'items' => $encodedItems, // Save the modified items with total discount and VAT
                'allocated_budget_amount' => (float) $request->totalBudget, // Directly cast to float
                'budget_utilization' => (float) $request->utilization, // Directly cast to float
                'total_discount' => (float) $request->totalDiscount, // Directly cast to float
                'total_vat' => (float) $request->totalVAT, // Directly cast to float
                'balance_budget' => $request->balanceBudget, // Directly cast to float
                'amount_requested' => (float) $request->requestAmount, // Directly cast to float
                'total_balance' => (float) $request->total_balanceBudget, // Directly cast to float
                'delivery_charges' => (float) $request->deliveryCharges,
                'status' => $request->status,
            ]);

            // Fetch the total budget allocated record
            // $totalBudgetAllocated = TotalBudgetAllocated::where('budget_project_id', $purchaseOrder->project_id)->first();
            // $lastCashFlow = CashFlow::where('budget_project_id', $purchaseOrder->project_id)
            //     ->where('category', 'Material')
            //     ->orderBy('date', 'desc')
            //     ->first();

            // if ($totalBudgetAllocated) {
            //     // Update total_lpo by adding the total_amount
            //     $totalBudgetAllocated->total_lpo += $request->totalAmount;
            //     $totalBudgetAllocated->total_material_cost -= $request->totalAmount;
            //     $totalBudgetAllocated->allocated_budget -= $request->totalAmount;

            //     $lastCashFlow->balance -= $request->totalAmount;
            //     $lastCashFlow->save();

            //     CashFlow::create([
            //         'date' => $purchaseOrder->date,
            //         'description' => $purchaseOrder->description,
            //         'category' => 'Material',
            //         'cash_inflow' => $request->cash_inflow ?? 0.0, // Ensure cash inflow is recorded
            //         'cash_outflow' => $request->totalAmount ?? 0.0, // Ensure cash outflow is recorded
            //         'committed_budget' => $lastCashFlow ? $lastCashFlow->committed_budget : 0,
            //         'balance' => $lastCashFlow->balance,
            //         'reference_code' => $poItems->po_number, // Reference code generated dynamically
            //         'budget_project_id' => $purchaseOrder->project_id,
            //     ]);

            //     // Save the updated record
            //     $totalBudgetAllocated->save();
            // }

            // Update purchase order status
            $purchaseOrder->status = 'submitted';
            $purchaseOrder->is_verified = 1;
            $purchaseOrder->save();

            // Return success response
            return response()->json(['message' => 'Purchase order items saved successfully!'], 200);
        } catch (\Exception $e) {
            \Log::error('Error saving purchase order items: ' . $e->getMessage());

            return response()->json(['message' => 'Failed to save purchase order items. ' . $e->getMessage()], 500);
        }
    }

    //destroy purchase order
    public function destroy($POID)
    {
        // Check if the logged-in user is authorized
        $userRole = auth()->user()->role;
        if (!in_array($userRole, ['Admin', 'CEO', 'Secretary'])) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'You are not authorized to delete this Purchase Order.']);
        }

        // Fetch the Purchase Order
        $purchaseOrder = PurchaseOrder::where('po_number', $POID)->first();

        // Check if the Purchase Order exists
        if (!$purchaseOrder) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Purchase Order not found!']);
        }

        // Delete associated Purchase Order Items
        $purchaseOrder->items()->delete();

        // Delete the Purchase Order
        $purchaseOrder->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Purchase Order and its associated items deleted successfully.');
    }

    //filter purchase order

    public function filterPurchaseOrders(Request $request)
    {
        $projects = BudgetProject::all();
        $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
        $budgetList = BudgetProject::get();
        $userList = User::get();
        $query = PurchaseOrder::query();

        $totalBudgetAllocated = TotalBudgetAllocated::all();

        if ($request->has('project_id') && $request->project_id != '') {
            $query->where('project_id', $request->project_id);
        }

        if ($request->has('project_person_id') && $request->project_person_id != '') {
            $query->where('requested_by', $request->project_person_id);
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('po_number') && $request->po_number) {
            $query->whereDate('po_number', $request->po_number);
        }

        $purchaseOrders = $query->get();

        return view('content.pages.pages-filter-purchase-order-list', compact('purchaseOrders', 'projects', 'users', 'userList', 'budgetList', 'totalBudgetAllocated'));
    }

    public function showPaymentOrder(Request $request)
    {
        return view('content.pages.show-budget-project-payment-order');
    }

    //get purchase order details
    public function getPurchaseOrder($poNumber)
    {
        // Fetch the purchase order with associated items
        $purchaseOrder = PurchaseOrder::with('items')->where('po_number', $poNumber)->first();

        if (!$purchaseOrder) {
            return response()->json(['error' => 'Purchase Order not found'], 404);
        }

        // Decode the items field for all associated items
        $decodedItems = $purchaseOrder->items->flatMap(function ($item) {
            return json_decode($item->items, true); // Decode the JSON `items` field
        });

        // Extract discountValue, vatValue, and deliveryCharges from the first item in the JSON array (if exists)
        $firstItem = $decodedItems->first();
        $discountValue = $firstItem['discountValue'] ?? 0;
        $vatValue = $firstItem['vatValue'] ?? 0;
        $deliveryCharges = $firstItem['deliveryCharges'] ?? 0;
        $totalVat = $firstItem['totalVAT'] ?? 0;
        $totalDiscount = $firstItem['totalDiscount'] ?? 0;
        $totalAmount = $firstItem['totalAmount'] ?? 0;

        // Transform the items to include only the required fields
        $filteredItems = $decodedItems->map(function ($item) {
            return [
                'itemNo' => $item['itemNo'] ?? null,
                'description' => $item['description'] ?? null,
                'quantity' => $item['quantity'] ?? null,
                'unitPrice' => $item['unitPrice'] ?? null,
                'itemTotal' => $item['itemTotal'] ?? null,
            ];
        });

        // Prepare the response
        return response()->json([
            'discountValue' => $discountValue,
            'vatValue' => $vatValue,
            'deliveryCharges' => $deliveryCharges,
            'totalDiscount' => $totalDiscount, // Summed total discount from items
            'totalVAT' => $totalVat, // Summed total VAT from items
            'totalAmount' => $totalAmount,
            'items' => $filteredItems->values(), // Include only filtered items
        ]);
    }
}
