<?php

namespace App\Http\Controllers;

use App\Models\BusinessClient;
use App\Models\BudgetProject;
use App\Models\PurchaseOrderSequence;
use App\Models\BusinessUnit;
use App\Models\User;
use App\Models\Project;
use App\Models\Salary;
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
use Illuminate\Http\Request;
use App\Models\PurchaseOrderItem;
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
    $userList = User::get();
    $loggedInUserId = Auth::id();
    $purchaseOrders = PurchaseOrder::where('prepared_by', $loggedInUserId)->get();


    // Retrieve budgets where manager_id matches the logged-in user ID
    $budgets = BudgetProject::where('manager_id', $loggedInUserId)->get();
    $budgetList = BudgetProject::get();

    return view("content.pages.pages-add-project-budget-purchase-order", compact('budgets', 'purchaseOrders', 'users', 'userList', 'budgetList'));
    
  }

    //add / show purchase order 
    public function storePurchaseOrder(Request $request)
    {

        //return response()->json($request->all());
        // Validate incoming request
        $validatedData = $request->validate([
            'startdate' => 'required|date',
            'payment_term' => 'required|string|max:255',
            'supplier_name' => 'nullable|string|max:255',
            'supplier_address' => 'nullable|string|max:255',
            'project_name' => 'nullable|integer',
            'description' => 'nullable|string',
            'project_person_id' => 'nullable|integer' // Use 'integer' or 'numeric'
        ]);

        $currentDate = Carbon::now();
        $monthName = $currentDate->format('M');  // Short month name (e.g. Jan, Feb)
        $year = $currentDate->format('Y');       // Full year (e.g. 2024)
        $formattedMonthYear = strtoupper($monthName . $year); // E.g. JAN2024
        
        // Get current date in the desired format (MMDDYYYY)
        $formattedDate = $currentDate->format('mdY');  // E.g. 09062024
        
        // Fetch the current sequence for the date or create a new one
        $poSequence = PurchaseOrderSequence::firstOrCreate(
            ['date' => $formattedDate],
            ['last_sequence' => 0]
        );

           // Increment the sequence number
           $newSerialNumber = str_pad($poSequence->last_sequence + 1, 4, '0', STR_PAD_LEFT);
  
           // Update the last sequence in the database
           $poSequence->last_sequence = $newSerialNumber;
           $poSequence->save();

        $referenceCode = 'PO' . $formattedDate . $newSerialNumber;

    
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
        return redirect('/pages/add-budget-project-purchase-order')->with(
            'success',
            'PO Created successfully!'
          );
    }

     //add purchase order 
     public function editPurchaseOrder($POID)
     {
         $purchaseOrder = PurchaseOrder::where('po_number', $POID)->first(); // Use first() to get a single record
         $budget = BudgetProject::where('id', $purchaseOrder->project_id)->first();
         $clients = BusinessClient::where('id', $budget->client_id);
         $units = BusinessUnit::where('id', $budget->unit_id);
         $budgets = Project::where('id', $budget->project_id);
         $requested = User::where('id', $purchaseOrder->requested_by)->first();
         $prepared = User::where('id', $purchaseOrder->prepared_by)->first();
         $utilization = $budget->getUtilization();


         $balanceBudget =  $budget->getRemainingBudget();

    //return response($requested);

     
         if ($purchaseOrder) {
             // Return the view with the purchase order data if found
             return view("content.pages.show-budget-project-purchase-order", compact('purchaseOrder', 'budget', 'clients', 'units', 'budgets', 'requested', 'prepared','utilization','balanceBudget'));
         } else {
             // Redirect with an error message if not found
             return redirect('/pages/add-budget-project-purchase-order')
                 ->withErrors(['error' => 'Purchase Order not found!']);
         }
     }

     //save purchase order 
     
     public function store(Request $request)
     {

        // return response()->json($request->all());
         try {
             // Validate request data
             $request->validate([
                 'poNumber' => 'required|string',
                 'items' => 'required|array',
                 'totalAmount' => 'required|numeric',
                 'totalDiscount' => 'required|numeric',
                 'totalVAT' => 'required|numeric',
             ]);


                   // Fetch purchase order id from poNumber
                $purchaseOrder = PurchaseOrder::where('po_number', $request->poNumber)->firstOrFail();
                $purchaseOrder->purchase_order_id = $purchaseOrder->id;
                $purchaseOrder->po_number = $purchaseOrder->poNumber;
                $purchaseOrder->total_amount = $purchaseOrder->poNumber;
                $purchaseOrder->total_discount = $purchaseOrder->poNumber;
                $purchaseOrder->total_vat = $purchaseOrder->poNumber;
        


     
             // Save or update purchase order items
             foreach ($request->items as $item) {

                 PurchaseOrderItem::updateOrCreate(
                     [
                         'item_code' => $item['item'],                          
                     ],
                     [
                         'description' => $item['description'],
                         'quantity' => $item['quantity'],
                         'unit_price' => $item['unitPrice'],
                         'total' => $item['itemTotal'],
                         'total_amount' => $request->totalAmount
                     ]
                 );
             }
     
             // Return success response
             return response()->json(['message' => 'Purchase order items saved successfully!'], 200);
     
         } catch (\Exception $e) {
             // Log the error for debugging
             \Log::error('Error saving purchase order items: ' . $e->getMessage());
     
             // Return error response
             return response()->json(['message' => 'Failed to save purchase order items.'.  $e->getMessage()], 500);
         }
     }
     
     
  
}
