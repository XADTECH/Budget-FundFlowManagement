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
        $users = User::all();

        $projects = BudgetProject::all();
        $loggedInUserId = Auth::id();
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Finance Manager' || auth()->user()->role == 'CEO') {
            $purchaseOrders = PurchaseOrder::all();
        } else {
            $purchaseOrders = PurchaseOrder::where('prepared_by', $loggedInUserId)->get();
        }

        // Retrieve budgets where manager_id matches the logged-in user ID
        $budgets = BudgetProject::where('manager_id', $loggedInUserId)->get();
        $budgetList = BudgetProject::all();
        $userList = User::all();
        $supplierlist = SupplierPrice::all();

        return view('content.pages.pages-add-project-budget-purchase-order', compact('supplierlist', 'budgets', 'purchaseOrders', 'users', 'userList', 'budgetList', 'projects'));
    }

    //add / show purchase order
    public function storePurchaseOrder(Request $request)
    {
        // return response($request->all());

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
            $allocatedBudgetExists = TotalBudgetAllocated::where('budget_project_id', $request->project_id)->exists();

            if (!$allocatedBudgetExists) {
                // Return back with error if the budget is not allocated
                return redirect()
                    ->back()
                    ->withErrors(['budget' => 'Budget is Not Allocated']);
            }

            // return response()->json($allocatedBudgetExists);

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
            $purchaseOrder->project_id = $request->project_id;
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
        $overhead = CostOverhead::where('budget_project_id', $purchaseOrder->project_id)->get();

        // Calculate budget utilization details
        $balanceBudget = $budget->getRemainingBudget();

        // Instead of committed_allocated_salary ...
        $salaryBudget = $totalBudgetAllocated?->total_salary;

        // Instead of committed_allocated_facility_cost ...
        $facilityBudget = $totalBudgetAllocated?->total_facility_cost;

        // Instead of committed_allocated_material_cost ...
        $materialBudget = $totalBudgetAllocated?->total_material_cost;

        // Instead of committed_allocated_capital_expenditure ...
        $capitalExpensesTotal = $totalBudgetAllocated?->total_capital_expenditure;

        // Instead of committed_allocated_financial_cost ...
        $financialBudget = $totalBudgetAllocated?->total_financial_cost;

        // Instead of committed_allocated_cost_overhead ...
        $overheadBudget = $totalBudgetAllocated?->total_cost_overhead;

        // Instead of committed_allocated_budget ...
        $totalBudget = $totalBudgetAllocated?->allocated_budget;

        // Returning the view with compact data
        return view('content.pages.show-budget-project-purchase-order', compact('purchaseOrder', 'overhead', 'overheadBudget', 'capitalExpensesTotal', 'salaryBudget', 'facilityBudget', 'materialBudget', 'financialBudget', 'capitalExpenses', 'budget', 'clients', 'units', 'budgets', 'requested', 'prepared', 'utilization', 'balanceBudget', 'poStatus', 'materials', 'financial', 'salaries', 'facilities', 'totalBudget'));
    }

    public function store(Request $request)
    {

        // return response($request->all());
        try {
            $request->validate([
                'poNumber'        => 'required|string',
                'items'           => 'required|array',
                'totalAmount'     => 'required|numeric',  // base total (sum of item costs)
                'totalDiscount'   => 'nullable|numeric',  // entire discount for the PO
                'totalVAT'        => 'nullable|numeric',  // entire VAT for the PO
                'deliveryCharges' => 'nullable|numeric',  // entire Delivery Charges for the PO
            ]);
    
            // 1) Fetch the Purchase Order
            $purchaseOrder = PurchaseOrder::where('po_number', $request->poNumber)->firstOrFail();
    
            // 2) Compute the final total at the PO level
            //    (sum of items = $request->totalAmount, then minus discount, plus VAT, plus delivery)
            $discount   = $request->totalDiscount   ?? 0;
            $vat        = $request->totalVAT        ?? 0;
            $delivery   = $request->deliveryCharges ?? 0;
    
            $totalAmountWithExtras = $request->totalAmount - $discount + $vat + $delivery;
    
            // 3) Get the Project's Budget
            $budget = TotalBudgetAllocated::where('budget_project_id', $purchaseOrder->project_id)->first();
            if (!$budget) {
                return back()->withErrors(['error' => 'Budget not found for this project.']);
            }
    
            // 4) Check if there's enough available balance
            $availableBalance = $budget->allocated_budget - $budget->total_lpo;
            if ($totalAmountWithExtras > $availableBalance) {
                return back()->withErrors(['error' => 'Insufficient balance budget for this project.']);
            }
    
            // 5) Update the Budget (top‐level) to reflect this new PO
            $budget->total_lpo        += $totalAmountWithExtras;
            $budget->allocated_budget -= $totalAmountWithExtras;
            $budget->remaining_fund    = $budget->initial_budget - $budget->total_lpo;
            $budget->save();
    
            // 6) Process each item — only use the item’s base cost for budget deduction & CashFlow
            foreach ($request->items as $item) {
                // Ensure required keys exist
                if (!isset($item['b_id'], $item['category'], $item['itemTotal'])) {
                    continue; // skip invalid items
                }
    
                $itemTotal  = (float) $item['itemTotal']; // raw item cost
                $category   = $item['category'];
                $budgetError = null;
    
                // Subtract from the correct category's budget
                switch ($category) {
                    case 'salary':
                        if ($budget->total_salary >= $itemTotal) {
                            $budget->total_salary -= $itemTotal;
                            $this->updateCashFlow($purchaseOrder, 'salary', $itemTotal);
                        } else {
                            $budgetError = 'Insufficient budget for salary category (Project ID: ' . $item['b_id'] . ')';
                        }
                        break;
    
                    case 'material':
                        if ($budget->total_material_cost >= $itemTotal) {
                            $budget->total_material_cost -= $itemTotal;
                            $this->updateCashFlow($purchaseOrder, 'material', $itemTotal);
                        } else {
                            $budgetError = 'Insufficient budget for material category (Project ID: ' . $item['b_id'] . ')';
                        }
                        break;
    
                    case 'facilities':
                        if ($budget->total_facility_cost >= $itemTotal) {
                            $budget->total_facility_cost -= $itemTotal;
                            $this->updateCashFlow($purchaseOrder, 'facilities', $itemTotal);
                        } else {
                            $budgetError = 'Insufficient budget for facilities category (Project ID: ' . $item['b_id'] . ')';
                        }
                        break;
    
                    case 'capital_expenses':
                        if ($budget->total_capital_expenditure >= $itemTotal) {
                            $budget->total_capital_expenditure -= $itemTotal;
                            $this->updateCashFlow($purchaseOrder, 'capital_expenses', $itemTotal);
                        } else {
                            $budgetError = 'Insufficient budget for capital expenses category (Project ID: ' . $item['b_id'] . ')';
                        }
                        break;
    
                    case 'overhead':
                        if ($budget->total_cost_overhead >= $itemTotal) {
                            $budget->total_cost_overhead -= $itemTotal;
                            $this->updateCashFlow($purchaseOrder, 'overhead', $itemTotal);
                        } else {
                            $budgetError = 'Insufficient budget for overhead category (Project ID: ' . $item['b_id'] . ')';
                        }
                        break;
    
                    case 'financial':
                        if ($budget->total_financial_cost >= $itemTotal) {
                            $budget->total_financial_cost -= $itemTotal;
                            $this->updateCashFlow($purchaseOrder, 'financial', $itemTotal);
                        } else {
                            $budgetError = 'Insufficient budget for financial category (Project ID: ' . $item['b_id'] . ')';
                        }
                        break;
    
                    default:
                        $budgetError = 'Unknown category found: ' . $category;
                }
    
                if ($budgetError) {
                    \Log::warning($budgetError);
                    return back()->withErrors(['budget_error' => $budgetError]);
                }
            }
    
            // Save final changes to category budgets
            $budget->save();
    
            // 7) Update the Purchase Order main record
            $purchaseOrder->subtotal         = $request->totalAmount;   // base sum of items
            $purchaseOrder->total_discount   = $discount;               // entire PO discount
            $purchaseOrder->vat              = $vat;                    // entire PO VAT
            $purchaseOrder->delivery_charges = $delivery;               // entire PO delivery
            $purchaseOrder->status           = 'submitted';
            $purchaseOrder->is_verified      = 1;
            $purchaseOrder->save();
    
            // 8) Save PurchaseOrderItem (storing items as JSON, if desired)
            //    *Keep in mind you can store the entire discount & vat in the record too,
            //     but we don't push them into each item anymore.
            PurchaseOrderItem::create([
                'purchase_order_id'       => $purchaseOrder->id,
                'po_number'               => $request->poNumber,
                'items'                   => json_encode($request->items),  // Store items as JSON
                'project_id'              => $request->budget, // Assuming budget represents project_id
                'initial_allocated_budget'=> $request->initialBudget ?? 0.00,
                'budget_utilization'      => $request->utilization ?? 0.00,
                'remaining_balance'       => $request->budgetBalance ?? 0.00,
                'requested_amount'        => $request->requestAmount ?? 0.00,
                'total_balance_budget'    => $request->remainBudget ?? 0.00,
                'total_vat'               => $request->totalVAT ?? 0.00,
                'total_discount'          => $request->totalDiscount ?? 0.00,
                'vat_value'               => $request->vatValue ?? 0.00,
                'discount_value'          => $request->discountValue ?? 0.00,
                'delivery_charges'        => $request->deliveryCharges ?? 0.00,
                'total_amount'            => $request->totalAmount ?? 0.00,
                'status'                  => 'submitted',
            ]);
            
    
            return response()->json(['message' => 'Purchase order items saved successfully!'], 200);
    
        } catch (\Exception $e) {
            \Log::error('Error saving purchase order items: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to save purchase order items. ' . $e->getMessage()], 500);
        }
    }

    
    private function updateCashFlow($purchaseOrder, $category, $itemTotal)
    {
        // Map input category to the canonical DB naming
        $categoryMap = [
            'salary'           => 'Salary',
            'material'         => 'Material',
            'facilities'       => 'Facility',
            'capital_expenses' => 'Capital Expenditure',
            'overhead'         => 'Overhead',
            'financial'        => 'Financial',
        ];
    
        $normalizedCategory = $categoryMap[$category] ?? null;
        if (!$normalizedCategory) {
            throw new \Exception('Unknown category found: ' . $category);
        }
    
        // Get last cash flow record for that category
        $lastCashFlow = CashFlow::where('budget_project_id', $purchaseOrder->project_id)
                                ->where('category', $normalizedCategory)
                                ->orderBy('date', 'desc')
                                ->first();
    
        // Update the previous balance
        if ($lastCashFlow) {
            $lastCashFlow->update([
                'balance' => $lastCashFlow->balance - $itemTotal,
            ]);
        }
    
        // Create new cash flow entry
        return CashFlow::create([
            'date'             => $purchaseOrder->date,
            'description'      => $purchaseOrder->description,
            'category'         => $normalizedCategory,
            'cash_inflow'      => 0.0,               // Typically 0 for an expense
            'cash_outflow'     => $itemTotal,
            'committed_budget' => $lastCashFlow ? $lastCashFlow->committed_budget : 0,
            'balance'          => $lastCashFlow ? $lastCashFlow->balance : (0 - $itemTotal),
            'reference_code'   => $purchaseOrder->po_number,
            'budget_project_id'=> $purchaseOrder->project_id,
        ]);
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

        // Delete associated Purchase Order Items using direct query
        PurchaseOrderItem::where('purchase_order_id', $purchaseOrder->id)->delete();

        // Delete the Purchase Order
        PurchaseOrder::where('id', $purchaseOrder->id)->delete();

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
// Get purchase order details
public function getPurchaseOrder($poNumber)
{
    // Fetch the purchase order using where clause
    $purchaseOrder = PurchaseOrder::where('po_number', $poNumber)->first();

    if (!$purchaseOrder) {
        return response()->json(['error' => 'Purchase Order not found'], 404);
    }

    // Fetch purchase order item details using the PO number
    $purchaseOrderItem = PurchaseOrderItem::where('po_number', $poNumber)->first();

    if (!$purchaseOrderItem) {
        return response()->json(['error' => 'Purchase Order item not found'], 404);
    }

    // Decode the items field from JSON safely
    $decodedItems = json_decode($purchaseOrderItem->items, true) ?? [];

    // Extract values from the purchase order item
    $data = [
        'id'                    => $purchaseOrderItem->id,
        'purchase_order_id'      => $purchaseOrderItem->purchase_order_id,
        'po_number'              => $purchaseOrderItem->po_number,
        'items'                  => $decodedItems,
        'project_id'             => $purchaseOrderItem->project_id,
        'initial_allocated_budget' => $purchaseOrderItem->initial_allocated_budget,
        'budget_utilization'     => $purchaseOrderItem->budget_utilization,
        'remaining_balance'      => $purchaseOrderItem->remaining_balance,
        'requested_amount'       => $purchaseOrderItem->requested_amount,
        'total_balance_budget'   => $purchaseOrderItem->total_balance_budget,
        'total_vat'              => $purchaseOrderItem->total_vat,
        'total_discount'         => $purchaseOrderItem->total_discount,
        'vat_value'              => $purchaseOrderItem->vat_value,
        'discount_value'         => $purchaseOrderItem->discount_value,
        'delivery_charges'       => $purchaseOrderItem->delivery_charges,
        'total_amount'           => $purchaseOrderItem->total_amount,
        'created_at'             => $purchaseOrderItem->created_at->toISOString(),
        'updated_at'             => $purchaseOrderItem->updated_at->toISOString(),
    ];

    return response()->json($data);
}




    //get projects for purchase order
    public function getProjects()
    {
        $search = $request->input('search');

        $projects = BudgetProject::where('reference_code', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get(['id', 'reference_code']);

        return response()->json($projects);
    }
}
