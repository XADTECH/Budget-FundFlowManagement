<?php

namespace App\Http\Controllers;

use App\Models\BudgetProject;
use App\Models\BusinessClient;
use App\Models\BusinessUnit;
use App\Models\CapitalExpenditure;
use App\Models\CostOverhead;
use App\Models\DirectCost;
use App\Models\FacilityCost;
use App\Models\FinancialCost;
use App\Models\IndirectCost;
use App\Models\MaterialCost;
use App\Models\RevenuePlan;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
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

    // Optionally, fetch project details using the ID
    // $project = Project::findOrFail($id);

    // Pass the project data to the view
    $budget = BudgetProject::with([
      'directCosts',
      'indirectCosts',
      'revenuePlans',
      'salaries',
      'facilityCosts',
      'materialCosts',
      'costOverheads',
      'financialCosts',
      'capitalExpenditures'
    ])
      ->where('id', $id)
      ->first();

    // Retrieve additional data for the view
    $projects = Project::findOrFail($budget->project_id);
    $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
    $clients = BusinessClient::findOrFail($budget->project_id);
    $units = BusinessUnit::findOrFail($budget->project_id);
    // $budgets = BudgetProject::get();

    $directCost = DirectCost::firstOrNew([
      'budget_project_id' => $id,
    ]);

    $indirectCost = IndirectCost::firstOrNew([
      'budget_project_id' => $id,
    ]);

    // Retrieve the most recent RevenuePlan record
    $latestRevenuePlan = RevenuePlan::where('budget_project_id', $id)
      ->latest('created_at')
      ->first();

    // Check if a record was found
    if ($latestRevenuePlan) {
      // Get the net_profit_after_tax value from the latest record
      $totalNetProfitAfterTax = $latestRevenuePlan->net_profit_after_tax;
      $totalNetProfitBeforeTax = $latestRevenuePlan->net_profit_before_tax;
    } else {
      // Handle the case where no records are found
      $totalNetProfitAfterTax = 0; // Or handle accordingly
      $totalNetProfitBeforeTax = 0; // Or handle accordingly
    }

    // Initialize total costs to 0
    $totalDirectCost = 0;
    $totalInDirectCost = 0;

    // Calculate direct cost if it exists
    if ($directCost->exists) {
      $totalDirectCost = $directCost->calculateTotalDirectCost();
    }

    // Calculate indirect cost if it exists
    if ($indirectCost->exists) {
      $totalInDirectCost = $indirectCost->calculateTotalIndirectCost();
    }

    $totalSalary = Salary::where('budget_project_id', $id)->sum('total_cost');
    $totalFacilityCost = FacilityCost::where('budget_project_id', $id)->sum('total_cost');
    $totalMaterialCost = MaterialCost::where('budget_project_id', $id)->sum('total_cost');
    $totalCostOverhead = CostOverhead::where('budget_project_id', $id)->sum('total_cost');
    $totalFinancialCost = FinancialCost::where('budget_project_id', $id)->sum('total_cost');
    $totalCapitalExpenditure = CapitalExpenditure::where('budget_project_id', $id)->sum('total_cost');
    return view('content.pages.pages-budget-project-summary-report',   compact(
      'id',
      'clients',
      'projects',
      'units',
      'users',
      'budget',
      'totalDirectCost',
      'totalSalary',
      'totalFacilityCost',
      'totalMaterialCost',
      'totalInDirectCost',
      'totalCostOverhead',
      'totalFinancialCost',
      'totalNetProfitAfterTax',
      'totalCapitalExpenditure',
      'totalNetProfitBeforeTax'
    ));
  }

  public function approveBudgetStatus(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'project_id' => 'required|integer|exists:budget_project,id',
      'status' => 'required',
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }


    BudgetProject::findOrFail($request->project_id)->update([
      'approval_status' => $request->status
    ]);

    return redirect('/pages/budget-lists')->with(
      'success',
      'Budget status updated successfully!'
    );
  }
}
