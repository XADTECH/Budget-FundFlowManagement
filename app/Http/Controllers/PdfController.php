<?php

namespace App\Http\Controllers;

use App\Models\BudgetProject;
use App\Models\BusinessClient;
use App\Models\BusinessUnit;
use App\Models\Project;
use App\Models\PurchaseOrder;
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
        $budget = BudgetProject::where('id', $purchaseOrder->project_id)->first();
        $clients = BusinessClient::where('id', operator: $budget->client_id)->first();
        $units = BusinessUnit::where('id', $budget->unit_id)->first();
        $budgets = Project::where('id', $budget->project_id)->first();
        $requested = User::where('id', $purchaseOrder->requested_by)->first();
        $prepared = User::where('id', $purchaseOrder->prepared_by)->first();
        $utilization = $budget->getUtilization();
        $poStatus = $purchaseOrder->status;

        $balanceBudget =  $budget->getRemainingBudget();
        $pdf = PDF::loadView('content.pages.pdf.pages-budget-project-summary-report', compact('purchaseOrder', 'budget', 'clients', 'units', 'budgets', 'requested', 'prepared', 'utilization', 'balanceBudget', 'poStatus'));

        // Download the PDF
        return $pdf->stream('test.pdf');
    }
}