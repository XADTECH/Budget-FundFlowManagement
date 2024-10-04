<?php

namespace App\Http\Controllers;

use App\Models\BudgetProject;
use App\Models\BusinessClient;
use App\Models\BusinessUnit;
use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;

class PdfController extends Controller
{
    public function download($POID)
    {
        // Load the view
        $purchaseOrder = PurchaseOrder::where('po_number', $POID)->first(); // Use first() to get a single record
        $purchaseOrderItem = PurchaseOrderItem::where('purchase_order_id', $purchaseOrder->id)->first(); // Use first() to get a single record
        $budget = BudgetProject::where('id', $purchaseOrder->project_id)->first();
        $clients = BusinessClient::where('id', operator: $budget->client_id)->first();
        $units = BusinessUnit::where('id', $budget->unit_id)->first();
        $budgets = Project::where('id', $budget->project_id)->first();
        $requested = User::where('id', $purchaseOrder->requested_by)->first();
        $prepared = User::where('id', $purchaseOrder->prepared_by)->first();
        $utilization = $purchaseOrderItem->budget_utilization;
        $poStatus = $purchaseOrder->status;

        $balanceBudget =  $budget->getRemainingBudget();
        $pdf = PDF::loadView('content.pages.pdf.pages-budget-project-summary-report', compact('purchaseOrder', 'budget', 'clients', 'units', 'budgets', 'requested', 'prepared', 'utilization', 'balanceBudget', 'poStatus','purchaseOrderItem'));

        // Download the PDF
        return $pdf->stream('test.pdf');
    }

    public function budgetSummary($POID)
    {
        $budget = BudgetProject::where('id', $POID)->first();
        $clients = BusinessClient::where('id', operator: $budget->client_id)->first();
        $units = BusinessUnit::where('id', $budget->unit_id)->first();
        $project = Project::where('id', $budget->project_id)->first();
        $user = User::where('id', $budget->manager_id)->first();

        // return response($budget);

        $pdf = PDF::loadView('content.pages.pdf.project_approval', compact('budget', 'clients', 'units','project', 'user'));



        // Download the PDF
        return $pdf->stream('test.pdf');
    }
}