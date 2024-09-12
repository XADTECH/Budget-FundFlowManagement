<?php

namespace App\Http\Controllers;

use App\Models\BusinessClient;
use App\Models\BudgetProject;
use App\Models\BusinessUnit;
use App\Models\User;
use App\Models\Project;
use App\Models\Salary;
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
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
  /**
   * Display a listing Budgets / Add Budget
   */
  public function index()
  {
    $projects = Project::get();
    $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
    $clients = BusinessClient::get();
    $units = BusinessUnit::get();
    $loggedInUserId = Auth::id();

    // Retrieve budgets where manager_id matches the logged-in user ID
    if (auth()->user()->role == 'Admin') {
      $budgets = BudgetProject::get();
    } else {

      $budgets = BudgetProject::where('manager_id', $loggedInUserId)->get();
    }

    return view('content.pages.pages-add-project-budget', compact('clients', 'projects', 'units', 'budgets', 'users'));
  }

  /**
   * Edit Budget PRoject
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
   * Create a Budget 
   */
  public function store(Request $request)
  {
      try {
          // Define validation rules
          $rules = [
              'startdate' => 'required|date',
              'enddate' => 'required|date|after_or_equal:startdate',
              'month' => 'required|date', // Full date validation
              'projectname' => 'required|exists:projects,id',
              'division' => 'required|exists:business_units,id',
              'client' => 'required|exists:business_clients,id',
              'region' => 'nullable|string|max:255',
              'sitename' => 'nullable|string|max:255',
              'description' => 'nullable|string|max:255',
              'budget_type' => 'required|string', // Added budget type validation
              'country' => 'required|string' // Country is required
          ];
  
          // Create a validator instance
          $validator = Validator::make($request->all(), $rules);
  
          // Check if validation fails
          if ($validator->fails()) {
              return back()->withErrors($validator)->withInput();
          }
  
          // Retrieve the validated data
          $validatedData = $validator->validated();
  
          // Extract IDs and fields from the validated data
          $month = $validatedData['month'];
          $projectId = $validatedData['projectname'];
          $businessUnitId = $validatedData['division'];
          $clientId = $validatedData['client'];
          $country = $validatedData['country']; // Country selection
          $region = $validatedData['region']; // Country selection
          $budgetType = $validatedData['budget_type']; // Budget type
  
          // Check if the logged-in user has the 'Project Manager' role
          $loggedInUser = auth()->user();
          
          // Check if the user is a 'Project Manager'
          if (!$loggedInUser->hasRole('Project Manager')) {
            return back()->withErrors(['message' => 'Only Project Managers can create project budgets.']);
        }
  
          // Generate names based on IDs
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
  
          // Get the current date in the desired format (MMDDYYYY)
          $formattedDate = Carbon::now()->format('mdY');
  
          // Fetch the current sequence for the date or create a new one
          $projectSequence = ProjectBudgetSequence::firstOrCreate(
              ['date' => $formattedDate],
              ['last_sequence' => 0]
          );
  
          // Increment the sequence number
          $newSerialNumber = str_pad($projectSequence->last_sequence + 1, 4, '0', STR_PAD_LEFT);
  
          // Update the last sequence in the database
          $projectSequence->last_sequence = $newSerialNumber;
          $projectSequence->save();
  
          // Generate the unique reference code
          $referenceCode = 'BP' . $formattedDate . $newSerialNumber;
  
          // Store the validated data along with the generated reference code
          $newProject = new BudgetProject();
          $newProject->reference_code = $referenceCode;
          $newProject->start_date = $validatedData['startdate'];
          $newProject->end_date = $validatedData['enddate'];
          $newProject->month = $validatedData['month'];
          $newProject->project_id = $projectId;
          $newProject->unit_id = $businessUnitId;
          $newProject->manager_id = $loggedInUser->id;
          $newProject->client_id = $clientId;
          $newProject->region = $validatedData['region'];
          $newProject->site_name = $validatedData['sitename'];
          $newProject->description = $validatedData['description'] ?? null;
          $newProject->budget_type = $budgetType; // Store the budget type
          $newProject->country = $country; // Store the selected country
          $newProject->region = $region; // Store the selected country
          $newProject->save();
  
          return redirect('/pages/add-project-budget')->with(
              'success',
              'Project Budget added successfully!'
          );
      } catch (Exception $e) {
          return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
      }
  }
  
  //store revenue 
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
      $revenuePlan->type = $request->type;
      $revenuePlan->contract = $request->contract;
      $revenuePlan->project = $request->project;
      $revenuePlan->amount = $request->amount;
      $revenuePlan->description = $request->description;
      
      // Save the revenue plan data
      $revenuePlan->save();
  
      // Run calculations after saving, passing in the pre-calculated costs
      $revenuePlan->calculateTotalProfit();
      $revenuePlan->calculateNetProfitBeforeTax($totalDirectCost, $totalIndirectCost);
      $revenuePlan->calculateTax();
      $revenuePlan->calculateNetProfitAfterTax();
      $revenuePlan->calculateProfitPercentage();
  
      return redirect('/pages/edit-project-budget/' .  $budgetProject->id)->with(
        'success',
        'Revenue added successfully!'
      );
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


  public function budgetsLists(Request $request)
  {
    $fields = $request->all();
    $projects = Project::get();
    $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
    $clients = BusinessClient::get();
    $units = BusinessUnit::get();


    $budgets = BudgetProject::query();

    if ($request->filled('start_date')) {
      $budgets->where('start_date', '>=', $request->start_date);
    }

    if ($request->filled('reference_code')) {
      $budgets->where('reference_code', $request->reference_code);
    }

    if ($request->filled('end_date')) {
      $budgets->where('end_date', '<=', $request->end_date);
    }
    if ($request->filled('project_id')) {
      $budgets->where('project_id', $request->project_id);
    }
    if ($request->filled('client_id')) {
      $budgets->where('client_id', $request->client_id);
    }
    if ($request->filled('manager_id')) {
      $budgets->where('manager_id', $request->manager_id);
    }
    if ($request->filled('approval_status')) {
      $budgets->where('approval_status', $request->approval_status);
    }

    $budgets = $budgets->get();
    return view('content.pages.pages-budget-list', compact('clients', 'fields', 'projects', 'units', 'budgets', 'users'));
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
 public function update(Request $request, $id)
{

  //return response()->json($request->all());
    $request->validate([
        'startdate' => 'required|date',
        'enddate' => 'nullable|date',
        'month' => 'nullable|date',
        'projectname' => 'required|exists:projects,id',
        'client' => 'required|exists:business_clients,id',
        'division' => 'required|exists:business_units,id',
        'region' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'budget_type' => 'required|string|max:255',
    ]);

    $budget = BudgetProject::findOrFail($id);
    $budget->update([
      'start_date' => $request->input('startdate'),
      'end_date' => $request->input('enddate'),
      'month' => $request->input('month'),
      'project_id' => $request->input('projectname'),
      'client_id' => $request->input('client'),
      'unit_id' => $request->input('division'),
      'site_name' => $request->input('sitename'),
      'region' => $request->input('region'),
      'country' => $request->input('country'),
      'description' => $request->input('description'),
      'budget_type' => $request->input('budget_type'),
  ]);

    return redirect('/pages/edit-project-budget/' .  $id)->with(
      'success',
      'CAPEX added successfully!'
    );
}

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function allocateBudget(Request $request, $id)
  {
      $project = BudgetProject::findOrFail($id);
      $amount = $request->input('amount');
      $project->allocateBudget($amount);

      return redirect()->route('projects.show', $id)->with('success', 'Budget allocated successfully.');
  }

  public function processPurchaseOrder(Request $request, $id)
  {
      $po = PurchaseOrder::findOrFail($id);
      $project = $po->project;
      $success = $project->processPurchaseOrder($po);

      if ($success) {
          return redirect()->route('purchaseOrders.show', $id)->with('success', 'Purchase Order approved and budget updated.');
      }

      return redirect()->route('purchaseOrders.show', $id)->with('error', 'Insufficient budget for Purchase Order.');
  }

  public function logDailyPaymentExpense(Request $request, $id)
  {
      $project = BudgetProject::findOrFail($id);
      $amount = $request->input('amount');
      $success = $project->logDailyPaymentExpense($amount);

      if ($success) {
          return redirect()->route('projects.show', $id)->with('success', 'Daily payment expense logged and budget updated.');
      }

      return redirect()->route('projects.show', $id)->with('error', 'Insufficient budget for daily payment expense.');
  }

  public function showCashFlow($id)
  {
      $project = BudgetProject::findOrFail($id);
      $cashFlows = $project->cashFlows()->get();
      return view('projects.cash_flow', compact('project', 'cashFlows'));
  }
}
