<?php

namespace App\Http\Controllers;

use App\Models\BusinessClient;
use App\Models\BudgetProject;
use App\Models\BusinessUnit;
use App\Models\User;
use App\Models\Project;
use App\Models\Salary;
use App\Models\FacilityCost;
use App\Models\CapitalExpenditure;
use App\Models\MaterialCost;
use App\Models\CostOverhead;
use App\Models\FinancialCost;
use App\Models\DirectCost;
use App\Models\RevenuePlan;
use App\Models\IndirectCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BudgetController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $projects = Project::get();
    $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
    $clients = BusinessClient::get();
    $units = BusinessUnit::get();
    $budgets = BudgetProject::get();
    return view('content.pages.pages-add-project-budget', compact('clients', 'projects', 'units', 'budgets', 'users'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function edit($project_id)
  {
    // Retrieve the budget project with the specified ID and related data
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
      ->where('id', $project_id)
      ->first();

    // Retrieve additional data for the view
    $projects = Project::get();
    $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
    $clients = BusinessClient::get();
    $units = BusinessUnit::get();
    $budgets = BudgetProject::get();

      $directCost = DirectCost::firstOrNew([
        'budget_project_id' => $project_id,
      ]);

      $indirectCost = IndirectCost::firstOrNew([
        'budget_project_id' => $project_id,
      ]);

    // Retrieve the most recent RevenuePlan record
    $latestRevenuePlan = RevenuePlan::where('budget_project_id', $project_id)
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

    $totalSalary = Salary::where('budget_project_id', $project_id)->sum('total_cost');
    $totalFacilityCost = FacilityCost::where('budget_project_id', $project_id)->sum('total_cost');
    $totalMaterialCost = MaterialCost::where('budget_project_id', $project_id)->sum('total_cost');
    $totalCostOverhead = CostOverhead::where('budget_project_id', $project_id)->sum('total_cost');
    $totalFinancialCost = FinancialCost::where('budget_project_id', $project_id)->sum('total_cost');
    $totalCapitalExpenditure = CapitalExpenditure::where('budget_project_id', $project_id)->sum('total_cost');


    // Now return the view with all necessary variables
    return view(
      'content.pages.pages-edit-project-budget',
      compact(
        'clients',
        'projects',
        'units',
        'budgets',
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
      )
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      // Define validation rules
      $rules = [
        'startdate' => 'required|date',
        'enddate' => 'required|date|after_or_equal:startdate',
        'month' => 'required|date', // Keep this as date for full date validation
        'projectname' => 'required|exists:projects,id',
        'division' => 'required|exists:business_units,id',
        'manager' => 'required|string', // Assuming 'manager' is a string representing the manager's name
        'client' => 'required|exists:business_clients,id',
        'region' => 'required|string|max:255',
        'sitename' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
      ];

      // Create a validator instance
      $validator = Validator::make($request->all(), $rules);

      // Check if validation fails
      if ($validator->fails()) {
        $errors = $validator->errors();
        return back()
          ->withErrors($errors)
          ->withInput();
      }

      // Retrieve the validated data
      $validatedData = $validator->validated();

      // Extract IDs and fields from the validated data
      $month = $validatedData['month'];
      $projectId = $validatedData['projectname'];
      $businessUnitId = $validatedData['division'];
      $managerID = $validatedData['manager'];
      $managerName = User::find($managerID)->first_name;
      $clientId = $validatedData['client'];

      // Fetch names associated with the provided IDs
      $projectName = Project::find($projectId)->name;
      $businessUnitName = BusinessUnit::find($businessUnitId)->source;
      $clientName = BusinessClient::find($clientId)->clientname;

      // Convert the month string to a DateTime object
      $monthDate = \DateTime::createFromFormat('Y-m-d', $month);
      if (!$monthDate) {
        throw new Exception('Invalid month format.');
      }
      $monthName = $monthDate->format('M');
      $year = $monthDate->format('Y');
      $formattedMonthYear = strtoupper($monthName . $year);

      // Generate a unique reference code using the payload month and fetched names
      $referenceCode =
        $formattedMonthYear . '-' . $projectName . '-' . $businessUnitName . '-' . $managerName . '-' . $clientName;

      // Ensure the reference code is unique
      $existingProject = BudgetProject::where('reference_code', $referenceCode)->first();
      if ($existingProject) {
        return back()
          ->withErrors([
            'reference_code' => 'The generated reference code is not unique. Please try again.',
          ])
          ->withInput();
      }

      // Store the validated data along with the generated reference code
      $newProject = new BudgetProject();
      $newProject->reference_code = $referenceCode;
      $newProject->start_date = $validatedData['startdate'];
      $newProject->end_date = $validatedData['enddate'];
      $newProject->month = $validatedData['month'];

      $newProject->project_id = $projectId; // Assuming IDs are correct
      $newProject->unit_id = $businessUnitId;
      $newProject->manager_id = $managerID; // If manager should be stored as a name, otherwise update this to store the ID
      $newProject->client_id = $clientId;
      $newProject->region = $validatedData['region'];
      $newProject->site_name = $validatedData['sitename'];
      $newProject->description = $validatedData['description'] ?? null; // Optional description
      $newProject->save();

      return redirect()
        ->route('add-project-budget')
        ->with('success', 'Project created successfully!');
    } catch (Exception $e) {
      return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
  }
  
  public function storeRevenue(Request $request)
  {
      // Validate the incoming request data
      $validator = Validator::make($request->all(), [
          'amount' => 'required|numeric',
          'description' => 'required|string|max:500',
          'project_id' => 'required|exists:budget_project,id', // Ensure project_id exists in budget_projects table
      ]);
  
      // If validation fails, return errors
      if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
      }
  
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
  
      // Create and save the new revenue plan
      $revenuePlan = new RevenuePlan();
      $revenuePlan->budget_project_id = $budgetProject->id;
      $revenuePlan->direct_cost_id = $directCost->id;
      $revenuePlan->indirect_cost_id = $indirectCost->id;
      $revenuePlan->type = $request->type;
      $revenuePlan->contract = $request->contract;
      $revenuePlan->project = $request->project;
      $revenuePlan->amount = $request->amount;
      $revenuePlan->description = $request->description;
      $revenuePlan->status = $request->status;
      
      // Save the revenue plan data
      $revenuePlan->save();
  
      // Run calculations after saving, passing in the pre-calculated costs
      $revenuePlan->calculateTotalProfit();
      $revenuePlan->calculateNetProfitBeforeTax($totalDirectCost, $totalIndirectCost);
      $revenuePlan->calculateTax();
      $revenuePlan->calculateNetProfitAfterTax();
      $revenuePlan->calculateProfitPercentage();
  
      // Return the response with the newly created revenue plan
      return response()->json([
          'message' => 'Revenue Plan saved successfully!',
          'revenue_plan' => $revenuePlan,
      ], 201);
  }

  //store capital expense 
  public function storeCapex(Request $request)
  {

    $validated = $request->validate([
      'type' => 'required|string',
      'contract' => 'required|string',
      'project' => 'required|exists:projects,id', // Ensure `projects` table exists
      'po' => 'required|string',
      'expense' => 'required|string',
      'cost_per_month' => 'required|numeric',
      'description' => 'required|string',
      'status' => 'nullable|string',
      'noOfPerson' => 'required|numeric', // Renamed to `no_of_person`
      'months' => 'required|numeric', // Renamed to `no_of_months`
      'project_id' => 'required|string', // Ensure `budget_projects` table exists
    ]);

    // Create a new salary record
    $capitalExpenditure = new CapitalExpenditure();
    $capitalExpenditure->budget_project_id = $request->project_id;
    $capitalExpenditure->type = $validated['type'];
    $capitalExpenditure->contract = $validated['contract'];
    $capitalExpenditure->project = $validated['project'];
    $capitalExpenditure->po = $validated['po'];
    $capitalExpenditure->expenses = $validated['expense'];
    $capitalExpenditure->cost_per_month = $validated['cost_per_month'];
    $capitalExpenditure->description = $validated['description'];
    $capitalExpenditure->status = $validated['status'];
    $capitalExpenditure->no_of_staff = $validated['noOfPerson']; // Map to your model attribute
    $capitalExpenditure->no_of_months = $validated['months']; // Map to your model attribute
    $capitalExpenditure->budget_project_id = $validated['project_id']; // Map to your model attribute
    $capitalExpenditure->calculateTotalCost();
    $capitalExpenditure->calculateAverageCost();
    $capitalExpenditure->save();

    return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with(
      'success',
      'CAPEX added successfully!'
    );
  }
  
  
  

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
