<?php

namespace App\Http\Controllers;

use App\Models\BudgetProject;
use App\Models\BusinessClient;
use App\Models\BusinessUnit;
use App\Models\CapitalExpenditure;
use App\Models\Loan;
use App\Models\CostOverhead;
use App\Models\DirectCost;
use App\Models\FacilityCost;
use App\Models\FinancialCost;
use App\Models\IndirectCost;
use App\Models\MaterialCost;
use App\Models\RevenuePlan;
use App\Models\CashFlow;
use App\Models\PurchaseOrder;
use App\Models\RemittanceTransfer;
use App\Models\PurchaseOrderItem;
use App\Models\TransferFromManagement;
use App\Models\LedgerEntry;
use App\Models\Invoice;
use App\Models\Sender;
use App\Models\ApprovedBudget;
use App\Models\TotalBudgetAllocated;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Subcontractor;
use App\Models\ThirdParty;
use App\Models\PettyCash;
use App\Models\NocPayment;


use Exception;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function showaddProjectView(Request $request)
    {
        return view('content.pages.pages-add-project-name');
    }

    public function addRecord(Request $request)
    {
        //return response()->json($request->all());
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'projectname' => 'required|string|max:255',
            ]);

            // Create a new Project record
            $project = new Project();
            $project->name = $validatedData['projectname'];
            $project->projectdetail = $request->projectdetail;
            $project->projectremark = $request->projectremark;
            $project->status = $request->status;
            $project->save();

            return response()->json(['success' => 'Project added successfully']);
        } catch (Exception $e) {
            // Log the exception message if needed
            \Log::error($e->getMessage());

            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function getRecords(Request $request)
    {
        try {
            $projects = Project::all();
            return response()->json($projects);
        } catch (Exception $e) {
            // Log the exception message if needed
            \Log::error($e->getMessage());

            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function updateRecord(Request $request)
    {
        //return response()->json($request->all());
        try {
            // Create a Validator instance
            $validator = Validator::make($request->all(), [
                'project_id' => 'required|integer|exists:projects,id',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }

            // Find the project record by ID
            $project = Project::findOrFail($request->input('project_id'));

            // Update the project record with validated data
            $project->update([
                'name' => $request->input('projectName', $project->name),
                'projectdetail' => $request->input('projectDetails', $project->projectdetail),
                'projectremark' => $request->input('projectRemarks', $project->projectremark),
                'status' => $request->input('projectStatus', $project->status),
            ]);

            return response()->json(['success' => 'Project updated successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function deleteRecord(Request $request)
    {
        try {
            // Validate that project_id is provided
            $validator = Validator::make($request->all(), [
                'project_id' => 'required|integer|exists:projects,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Find the project record by ID
            $project = Project::find($request->input('project_id'));

            if (!$project) {
                return response()->json(['message' => 'Project record not found.'], 404);
            }

            // Delete the project record
            $project->delete();

            return response()->json(['success' => 'Project deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the project record.'], 500);
        }
    }

    public function showaddBusinessUnit()
    {
        return view('content.pages.pages-add-business-unit');
    }

    public function showaddBusinessClient()
    {
        return view('content.pages.pages-add-business-client');
    }

    // Show budget project report summary
    public function showBudgetProjectReport($id)
    {
        // Fetch the budget project with related models
        $budget = BudgetProject::with([
            'directCosts', 'indirectCosts', 'revenuePlans', 'salaries', 
            'facilityCosts', 'materialCosts', 'costOverheads', 
            'financialCosts', 'capitalExpenditures'
        ])->where('id', $id)->first();
    
        if (!$budget) {
            return redirect()->back()->with('error', 'Budget project not found');
        }
    
        // Fetch additional project-related details
        $existingPettyCash = PettyCash::where('project_id', $budget->id)->first();
        $existingSubcon = Subcontractor::where('project_id', $budget->id)->first();
        $existingThirdparty = ThirdParty::where('project_id', $budget->id)->first();
        $existingNocPayment = NocPayment::where('project_id', $budget->id)->first();
    
        // Ensure related entities exist before accessing them
        $projects = Project::find($budget->project_id) ?? new Project();
        $clients = BusinessClient::find($budget->client_id) ?? new BusinessClient();
        $units = BusinessUnit::find($budget->unit_id) ?? new BusinessUnit();
    
        $users = User::all();
    
        // Fetch all records with safety checks
        $allProjects = Project::all();
        $facilities = FacilityCost::all();
        $materials = MaterialCost::all();
        $overheads = CostOverhead::all();
        $financials = FinancialCost::all();
        $capitalExpenditures = CapitalExpenditure::all();
        $revenuePlans = RevenuePlan::all();
        $salaries = Salary::all();
    
        // Retrieve direct and indirect cost with default values
        $directCost = DirectCost::firstOrNew(['budget_project_id' => $id]);
        $indirectCost = IndirectCost::firstOrNew(['budget_project_id' => $id]);
    
        // Retrieve the most recent RevenuePlan record
        $latestRevenuePlan = RevenuePlan::where('budget_project_id', $id)->latest('created_at')->first();
    
        // Check if a revenue plan record was found
        $totalNetProfitAfterTax = $latestRevenuePlan->net_profit_after_tax ?? 0;
        $totalNetProfitBeforeTax = $latestRevenuePlan->net_profit_before_tax ?? 0;
        $totalRevenue = $latestRevenuePlan ? $latestRevenuePlan->sumTotalAmount($budget->id) ?? 0 : 0;
    
        // Calculate total costs with null checks
        $totalDirectCost = $directCost->exists ? $directCost->calculateTotalDirectCost() : 0;
        $totalInDirectCost = $indirectCost->exists ? $indirectCost->calculateTotalIndirectCost() : 0;
    
        // Summing cost-related data, defaulting to 0 if null
        $totalSalary = Salary::where('budget_project_id', $id)->sum('total_cost') ?? 0;
        $totalFacilityCost = FacilityCost::where('budget_project_id', $id)->sum('total_cost') ?? 0;
        $totalMaterialCost = MaterialCost::where('budget_project_id', $id)->sum('total_cost') ?? 0;
        $totalCostOverhead = CostOverhead::where('budget_project_id', $id)->sum('amount') ?? 0;
        $totalFinancialCost = FinancialCost::where('budget_project_id', $id)->sum('total_cost') ?? 0;
        $totalCapitalExpenditure = CapitalExpenditure::where('budget_project_id', $id)->sum('total_cost') ?? 0;
    
        return view('content.pages.pages-budget-project-summary-report', compact(
            'id', 'clients', 'projects', 'units', 'users', 'budget', 'totalDirectCost', 
            'totalSalary', 'totalFacilityCost', 'totalMaterialCost', 'totalInDirectCost', 
            'totalCostOverhead', 'totalFinancialCost', 'totalNetProfitAfterTax', 
            'totalCapitalExpenditure', 'totalNetProfitBeforeTax', 'allProjects', 
            'facilities', 'materials', 'overheads', 'financials', 'capitalExpenditures', 
            'revenuePlans', 'salaries', 'totalRevenue', 'existingPettyCash', 
            'existingSubcon', 'existingThirdparty', 'existingNocPayment'
        ));
    }

    public function approveBudgetStatus(Request $request)
    {
        // Step 1: Validate the incoming request data
        $validatedData = $request->validate([
            'status' => 'required|string',
            'project_id' => 'required|integer',
            'total_salary' => 'required|numeric',
            'total_facility_cost' => 'required|numeric',
            'total_material_cost' => 'required|numeric',
            'total_cost_overhead' => 'required|numeric',
            'total_financial_cost' => 'required|numeric',
            'total_capital_expenditure' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'expected_net_profit_after_tax' => 'required|numeric',
            'expected_net_profit_before_tax' => 'required|numeric',
            'reference_code' => 'required|string',
            'duration' => 'nullable|string', // New field for duration
        ]);

        // Step 2: Extract necessary values from the validated data
        $approvalStatus = $validatedData['status'];
        $projectId = $validatedData['project_id'];
        $reference_code = $validatedData['reference_code'];
        $approveBy = auth()->user()->id; // Get the authenticated user's ID

        // Step 3: If approval_status is not 'approve', delete the related record
        if ($approvalStatus !== 'approve') {
            $budget = BudgetProject::where('id', $projectId)->update([
                'approval_status' => $approvalStatus,
                'approve_by' => null,
                'total_budget_allocated' => 0,
            ]);
            ApprovedBudget::where('budget_project_id', $projectId)->delete();
            TotalBudgetAllocated::where('budget_project_id', $projectId)->delete();
            CashFlow::where('budget_project_id', $projectId)->delete();
            Invoice::where('invoice_budget_project_id', $projectId)->delete();
            LedgerEntry::where('budget_project_id', $projectId)->delete();
            Sender::where('budget_project_id', $projectId)->delete();
            TransferFromManagement::where('budget_project_id', $projectId)->delete();
            RemittanceTransfer::where('budget_project_id', $projectId)->delete();
            Loan::where('budget_project_id', $projectId)->delete();

            $po = PurchaseOrder::where('project_id', $projectId)->first();

            if ($po) {
                PurchaseOrder::where('project_id', $projectId)->delete();
                PurchaseOrderItem::where('po_number', $po->po_number)->delete();
            }

            return redirect()
                ->back()
                ->with(['success' => 'Budget record deleted due to status: ' . $approvalStatus]);
        }

        // Step 4: If approval_status is 'approve', create or update a single record for the project
        if ($approvalStatus === 'approve') {
            // Update the BudgetProject model
            BudgetProject::where('id', $projectId)->update([
                'approval_status' => 'approve',
                'approve_by' => $approveBy,
            ]);

            ApprovedBudget::updateOrCreate(
                [
                    'budget_project_id' => $projectId,
                ],
                [
                    'total_salary' => $validatedData['total_salary'],
                    'total_facility_cost' => $validatedData['total_facility_cost'],
                    'total_material_cost' => $validatedData['total_material_cost'],
                    'total_cost_overhead' => $validatedData['total_cost_overhead'],
                    'total_financial_cost' => $validatedData['total_financial_cost'],
                    'total_capital_expenditure' => $validatedData['total_capital_expenditure'],
                    'expected_net_profit_before_tax' => $validatedData['expected_net_profit_before_tax'],
                    'expected_net_profit_after_tax' => $validatedData['expected_net_profit_after_tax'],
                    'approved_budget' => $validatedData['total_cost'],
                    'reference_code' => $reference_code,
                ],
            );

            return redirect()
                ->back()
                ->with(['success' => 'Budget approved and updated successfully']);
        }
    }

    // DELETE SALARY
    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();
        return redirect()->back()->with('success', 'Salary deleted successfully.');
    }

    // DELETE FACILITY
    public function facility($id)
    {
        $facility = FacilityCost::findOrFail($id);
        $facility->delete();
        return redirect()->back()->with('success', 'Facility Cost deleted successfully.');
    }

    //DELETE MATERIAL
    public function material($id)
    {
        $material = MaterialCost::findOrFail($id);
        $material->delete();
        return redirect()->back()->with('success', 'Material Cost deleted successfully.');
    }

    //DELETE OVER HEAD
    public function costOverhead($id)
    {
        $costOverhead = CostOverhead::findOrFail($id);
        $costOverhead->delete();
        return redirect()->back()->with('success', 'Overhead Cost deleted successfully.');
    }

    //DELETE FINANCIAL COST
    public function financialCost($id)
    {
        $financialCost = FinancialCost::findOrFail($id);
        $financialCost->delete();
        return redirect()->back()->with('success', 'Financial Cost deleted successfully.');
    }

    //DELETE CAPITAL EXPENDITE
    public function capitalExpenditure($id)
    {
        $financialCost = capitalExpenditure::findOrFail($id);
        $financialCost->delete();
        return redirect()->back()->with('success', 'Capital Cost deleted successfully.');
    }

    //DELETE REVENUE
    public function deleteRevenue($id)
    {
        $financialCost = RevenuePlan::findOrFail($id);
        $financialCost->delete();
        return redirect()->back()->with('success', 'Revenue Cost deleted successfully.');
    }
    
    //bulk delete salary
    public function bulkDeleteSalary(Request $request)
    {
        // Retrieve the array of IDs from the request
        $ids = $request->input('ids', []);

        if (!is_array($ids) || count($ids) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'No IDs provided for bulk delete.'
            ], 400);
        }

        // Perform the bulk deletion
        Salary::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Salaries deleted successfully.'
        ]);
    }

    /**
     * Bulk delete Facilities
     */
    public function bulkDeleteFacilities(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || count($ids) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'No IDs provided for bulk delete.'
            ], 400);
        }

        FacilityCost::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Facilities deleted successfully.'
        ]);
    }
    

    /**
     * Bulk delete Material
     */
    public function bulkDeleteMaterial(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || count($ids) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'No IDs provided for bulk delete.'
            ], 400);
        }

        MaterialCost::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Materials deleted successfully.'
        ]);
    }
    
    public function bulkDeleteOverhead(Request $request)
{
    $ids = $request->input('ids', []);
    if (!is_array($ids) || empty($ids)) {
        return response()->json(['success' => false, 'message' => 'No IDs provided'], 400);
    }
    CostOverhead::whereIn('id', $ids)->delete();
    return response()->json(['success' => true, 'message' => 'Overhead costs deleted']);
}

public function bulkDeleteFinancial(Request $request)
{
    $ids = $request->input('ids', []);
    if (!is_array($ids) || empty($ids)) {
        return response()->json(['success' => false, 'message' => 'No IDs provided'], 400);
    }
    FinancialCost::whereIn('id', $ids)->delete();
    return response()->json(['success' => true, 'message' => 'Financial costs deleted']);
}

//bulk delete capital expenditure
public function bulkDeleteCapital(Request $request)
{
    $ids = $request->input('ids', []);
    if (!is_array($ids) || count($ids) === 0) {
        return response()->json([
            'success' => false,
            'message' => 'No IDs provided for deletion.'
        ], 400);
    }

    // Adjust the model name if your model is not "CapitalExpenditure"
    CapitalExpenditure::whereIn('id', $ids)->delete();

    return response()->json([
        'success' => true,
        'message' => 'CAPEX records deleted successfully.'
    ]);
}



    //UPDATE SALARY
    public function update(Request $request, $id)
    {
        // return response($request->all());
        $salary = Salary::findOrFail($id);
        $salary->update($request->all());
        $salary->calculateTotalCost();
        $salary->calculateAverageCost();
        return redirect()->back()->with('success', 'Salary updated successfully.');
    }

    //update facility

    public function updateFacility(Request $request, $id)
    {
        // return response($request->all());
        $facility = FacilityCost::findOrFail($id);
        $facility->update($request->all());
        $facility->calculateTotalCost();
        $facility->calculateAverageCost();
        return redirect()->back()->with('success', 'Facility cost updated successfully');
    }
    
    

    public function updateMaterial(Request $request, $id)
    {
        // return response($request->all());
        $material = MaterialCost::findOrFail($id);
        $material->update($request->all());
        $material->calculateTotalCost();
        $material->calculateAverageCost();
        return redirect()->back()->with('success', 'Material cost updated successfully');
    }

    public function updateOverHead(Request $request, $id)
    {
        // return response($request->all());
        // $overhead = costOverhead::findOrFail($id);
        $costOverhead = CostOverhead::findOrFail($id);
        $costOverhead->type = $request['type'];
        $costOverhead->project = $request['project'];
        $costOverhead->po = $request['po'];
        $costOverhead->expenses = $request['expenses'];
        $costOverhead->amount = $request['amount'];
        $costOverhead->amount = $costOverhead->calculateBasedOnExpenseHead();
        $costOverhead->update();

        return redirect()->back()->with('success', 'overhead cost updated successfully');
    }

    public function updateFinancial(Request $request, $id)
    {
        // return response($request->all());
        $financialcost = FinancialCost::findOrFail($id);
        $financialcost->type = $request['type'];
        $financialcost->project = $request['project'];
        $financialcost->po = $request['po'];
        $financialcost->expenses = $request['expenses'];
        $financialcost->total_cost = $request['amount'];
        $financialcost->percentage = $request['amount'];
        $financialcost->total_cost = $financialcost->calculateTotalCost($request['project']);
        $financialcost->update();

        return redirect()->back()->with('success', 'Financial cost updated successfully');
    }

    public function updateCapitalExpense(Request $request, $id)
    {
        // return response($request->all());

        $capitalExpenditure = CapitalExpenditure::findOrFail($id);
        $capitalExpenditure->type = $request['type'];
        $capitalExpenditure->project = $request['project'];
        $capitalExpenditure->po = $request['po'];
        $capitalExpenditure->expenses = $request['expenses'];
        $capitalExpenditure->description = $request['description'];
        $capitalExpenditure->status = $request['status'];
        $capitalExpenditure->total_number = $request['total_number'];
        $capitalExpenditure->cost = $request['cost'];
        $capitalExpenditure->calculateTotalCost();
        $capitalExpenditure->update();
        return redirect()->back()->with('success', 'Capital cost updated successfully');
    }

    public function updateRevenuePlan(Request $request, $id)
    {
        // Find the related budget project
        $budgetProject = BudgetProject::find($request->project_id);

        // Initialize DirectCost and IndirectCost for the project
        $directCost = DirectCost::firstOrNew(['budget_project_id' => $request->project_id]);
        $indirectCost = IndirectCost::firstOrNew(['budget_project_id' => $request->project_id]);

        // Initialize total costs to 0
        $totalDirectCost = 0;
        $totalIndirectCost = 0;

        // Calculate direct cost if it exists
        if ($directCost->exists) {
            $totalDirectCost = $directCost->calculateTotalDirectCost();
        }

        // Calculate indirect cost if it exists
        if ($indirectCost->exists) {
            $totalIndirectCost = $indirectCost->calculateTotalIndirectCost();
        }
        // return response($request->all());
        $revenuePlan = RevenuePlan::findOrFail($id);
        $revenuePlan->update($request->all());
        $revenuePlan->calculateTotalProfit();
        $revenuePlan->calculateNetProfitBeforeTax($totalDirectCost, $totalIndirectCost);
        $revenuePlan->calculateTax();
        $revenuePlan->calculateNetProfitAfterTax();
        $revenuePlan->calculateProfitPercentage();
        return redirect()->back()->with('success', 'Revenue updated successfully');
    }
}
