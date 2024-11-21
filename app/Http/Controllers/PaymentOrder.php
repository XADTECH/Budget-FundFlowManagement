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
use App\Models\SupplierPrice;
use App\Models\PaymentOrderModel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentOrder extends Controller
{
    //add payment order
    public function addPaymentOrder(Request $request)
    {
        $projects = BudgetProject::all();
        $paymentOrders = PaymentOrderModel::all();
        return view('content.pages.pages-add-budget-project-payment-order', compact('projects', 'paymentOrders'));
    }

    public function storePaymentOrder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
        ]);

        // Extract formatted date (DDMMYYYY)
        $formattedDate = Carbon::parse($validated['payment_date'])->format('dmy');

        // Convert payment method to uppercase and replace spaces with dashes
        $formattedMethod = Str::upper(Str::slug($validated['payment_method'], '-'));

        // Generate unique payment order number
        $paymentOrderNumber = "PO{$formattedDate}-{$formattedMethod}";

        // Create the payment order
        $paymentOrder = [
            'payment_order_number' => $paymentOrderNumber,
            'payment_date' => $validated['payment_date'],
            'payment_method' => $validated['payment_method'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Save to database (assuming a 'payment_orders' table exists)
        DB::table('payment_orders')->insert($paymentOrder);

        // Return response
        return response()->json([
            'message' => 'Payment order created successfully',
            'payment_order' => $paymentOrder,
        ]);
    }

    public function show(Request $request)
    {

        $pr = $request->payment_order_number;
        // Find the payment order by payment_order_number
        $po = PaymentOrderModel::where('payment_order_number', $pr)->first();
        if (!$po) {
            return redirect()
                ->back() // Replace 'paymentOrder.index' with your fallback route
                ->withErrors(['error' => 'Payment Order not found.']);
        }

        // If found, return the view with the payment order details
        return view('content.pages.show-budget-project-payment-order', compact('po'));
    }
}
