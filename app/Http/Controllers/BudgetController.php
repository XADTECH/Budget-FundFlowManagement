<?php

namespace App\Http\Controllers;

use App\Models\BusinessClient;
use App\Models\BudgetProject;
use App\Models\BusinessUnit;
use App\Models\User;
use App\Models\Project;
use App\Models\PettyCash;
use App\Models\IndirectCost;
use App\Models\NocPayment;
use App\Models\Salary;
use App\Models\ProjectBudgetSequence;
use App\Models\PurchaseOrderController;
use App\Models\FacilityCost;
use App\Models\CapitalExpenditure;
use App\Models\MaterialCost;
use App\Models\TotalBudgetAllocated;
use App\Models\CostOverhead;
use App\Models\FinancialCost;
use App\Models\DirectCost;
use App\Models\CashFlow;
use App\Models\ApprovedBudget;
use App\Models\RevenuePlan;
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
        $budget = BudgetProject::with(['directCosts', 'indirectCosts', 'revenuePlans', 'salaries', 'facilityCosts', 'materialCosts', 'costOverheads', 'financialCosts', 'capitalExpenditures'])
            ->where('id', $project_id)
            ->first();

        // Retrieve the budget project with the specified ID and related data
        $project = Project::where('id', $project_id)->first();

        // Initialize total costs to 0
        $totalDirectCost = 0;
        $totalInDirectCost = 0;

        $directCost = DirectCost::firstOrNew([
            'budget_project_id' => $project_id,
        ]);

        $indirectCost = IndirectCost::firstOrNew([
            'budget_project_id' => $project_id,
        ]);

        // Calculate direct cost if it exists
        if ($directCost->exists) {
            $totalDirectCost = $directCost->calculateTotalDirectCost();
        }

        // Calculate indirect cost if it exists
        if ($indirectCost->exists) {
            $totalInDirectCost = $indirectCost->calculateTotalIndirectCost();
        }

        $FinancialType = [
            'Risk' => 'Risk',
            'Financial Cost' => 'Financial Cost',
        ];

        $FinancialAmount = [
            'Risk' => '0.05',
            'Financial Cost' => '0.01',
        ];

        $type = [
            'HO Cost' => 'HO Cost',
            'Annual Benefit' => 'Annual Benefit',
            'Insurance Cost' => 'Insurance Cost',
            'Visa Renewal' => 'Visa Renewal',
            'Depreciation Tools' => 'Depreciation Tools',
        ];

        // Define amounts for each type
        $amounts = [
            'HO Cost' => 574,
            'Annual Benefit' => 0.15,
            'Insurance Cost' => 92,
            'Visa Renewal' => 208,
            'Depreciation Tools' => 0,
        ];

        $costOverhead = CostOverhead::where('budget_project_id', $project_id)->first();
        $salaryExists = Salary::where('visa_status', 'Xad Visa')->where('budget_project_id', $project_id)->exists();
        $financialExists = FinancialCost::where('budget_project_id', $project_id)->exists();

        if ($salaryExists) {
            if ($costOverhead == null) {
                // Create new records if no cost overhead exists
                foreach ($type as $key => $expenseHead) {
                    $costOverhead = new CostOverhead();
                    $costOverhead->calculateBasedOnExpenseHead(
                        $costOverhead,
                        $expenseHead, // Use the current expense head
                        $indirectCost, // Indirect cost ID
                        'OverHead Cost', // Cost type

                        $budget->project_id,
                        'OPEX', // PO

                        $amounts[$key], // Access the amount
                        $project_id, // Budget project ID
                    );
                }
            } else {
                // Update existing records
                foreach ($type as $key => $expenseHead) {
                    // Retrieve existing CostOverhead based on budget_project_id and expense head
                    $existingCostOverhead = CostOverhead::where('budget_project_id', $project_id)->where('expenses', $expenseHead)->first();

                    if ($existingCostOverhead) {
                        // Perform calculations based on the expense head
                        switch ($expenseHead) {
                            case 'HO Cost':
                                $sumAmount = Salary::where('visa_status', 'Xad Visa')->where('budget_project_id', $project_id)->sum('percentage_cost');
                                $existingCostOverhead->amount = $amounts[$key] * $sumAmount;
                                break;

                            case 'Annual Benefit':
                                // Sum total_cost for all salaries related to the project
                                $sumAmount = Salary::where('budget_project_id', $project_id)->sum('percentage_cost');
                                $existingCostOverhead->amount = $amounts[$key] * $sumAmount;

                                break;

                            case 'Insurance Cost':
                                $sumAmount = Salary::where('visa_status', 'Xad Visa')->where('budget_project_id', $project_id)->sum('percentage_cost');
                                $existingCostOverhead->amount = $amounts[$key] * $sumAmount;
                                break;

                            case 'Visa Renewal':
                                $sumAmount = Salary::where('visa_status', 'Xad Visa')->where('budget_project_id', $project_id)->sum('percentage_cost');
                                $existingCostOverhead->amount = $amounts[$key] * $sumAmount;

                                break;

                            case 'Depreciation Tools':
                                // Sum total_cost for capital expenditures related to the project and divide by 24
                                $sumAmount = CapitalExpenditure::where('budget_project_id', $project_id)->sum('total_cost') / 24;
                                $existingCostOverhead->amount = $sumAmount;
                                break;
                        }

                        // Update other necessary fields
                        $existingCostOverhead->in_direct_cost_id = $indirectCost->id;
                        $existingCostOverhead->type = 'OverHead Cost';
                        $existingCostOverhead->project = $project_id;
                        $existingCostOverhead->po = 'OPEX'; // Adjust as necessary

                        // Save the updated record
                        $existingCostOverhead->save();
                    }
                }
            }
        }

        if ($totalDirectCost > 0) {
            if ($financialExists == null) {
                // Create new records if no cost overhead exists
                foreach ($FinancialType as $key => $expenseHead) {
                    $financial = new FinancialCost();
                    $financial->addFinancialCost(
                        $expenseHead, // Use the current expense head
                        'Financial Cost', // Cost type
                        'OPEX', // PO
                        $FinancialAmount[$key], // Access the amount
                        $budget->project_id,
                        $project_id, // Budget project ID
                        $totalDirectCost,
                    );
                }
            } else {
                foreach ($FinancialType as $key => $expenseHead) {
                    // Retrieve the first matching FinancialCost record
                    $existingFinancial = FinancialCost::where('budget_project_id', $project_id)->where('expenses', $expenseHead)->first(); // Use first() instead of get()

                    if ($existingFinancial) {
                        // Perform specific calculations based on the expense head
                        switch ($expenseHead) {
                            case 'Risk':
                                $existingFinancial->total_cost = $FinancialAmount[$key] * $totalDirectCost;
                                $existingFinancial->percentage = 0;
                                break;

                            case 'Financial Cost':
                                $existingFinancial->total_cost = $FinancialAmount[$key] * $totalDirectCost;
                                $existingFinancial->percentage = 0;
                                break;
                        }

                        // Update the common fields
                        $existingFinancial->type = 'Financial Cost';
                        $existingFinancial->project = $budget->project_id;
                        $existingFinancial->po = 'OPEX';
                        $existingFinancial->expenses = $expenseHead;
                        $existingFinancial->budget_project_id = $project_id;

                        // Save the updated record
                        $existingFinancial->save();
                    }
                }
            }
        }

        // Retrieve additional data for the view
        $projects = Project::get();
        $users = User::whereIn('role', ['Project Manager', 'Client Manager'])->get(['id', 'first_name', 'last_name']);
        $clients = BusinessClient::get();
        $units = BusinessUnit::get();
        $budgets = BudgetProject::get();
        $overHeads = CostOverhead::where('budget_project_id', $project_id)->first();

        // Retrieve the most recent RevenuePlan record
        $latestRevenuePlan = RevenuePlan::where('budget_project_id', $project_id)->latest('created_at')->first();

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

        $totalSalary = Salary::where('budget_project_id', $project_id)->sum('total_cost');
        $totalFacilityCost = FacilityCost::where('budget_project_id', $project_id)->sum('total_cost');
        $totalMaterialCost = MaterialCost::where('budget_project_id', $project_id)->sum('total_cost');
        $totalCostOverhead = CostOverhead::calculateTotalOverhead($project_id);
        $totalFinancialCost = FinancialCost::where('budget_project_id', $project_id)->sum('total_cost');
        $totalCapitalExpenditure = CapitalExpenditure::where('budget_project_id', $project_id)->sum('total_cost');

        $existingPettyCash = PettyCash::where('project_id', $project_id)->first();

        $existingNocPayment = NocPayment::where('project_id', $project_id)->first();

        return view('content.pages.pages-edit-project-budget', compact('clients', 'overHeads', 'projects', 'units', 'budgets', 'users', 'budget', 'totalDirectCost', 'totalSalary', 'totalFacilityCost', 'totalMaterialCost', 'totalInDirectCost', 'totalCostOverhead', 'totalFinancialCost', 'totalNetProfitAfterTax', 'totalCapitalExpenditure', 'totalNetProfitBeforeTax', 'existingNocPayment', 'existingPettyCash'));
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
                'country' => 'required|string', // Country is required
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
            $projectSequence = ProjectBudgetSequence::firstOrCreate(['date' => $formattedDate], ['last_sequence' => 0]);

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

            return redirect('/pages/add-project-budget')->with('success', 'Project Budget added successfully!');
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

        // Calculate total costs
        $totalDirectCost = $directCost->exists ? $directCost->calculateTotalDirectCost() : 0;
        $totalIndirectCost = $indirectCost->exists ? $indirectCost->calculateTotalIndirectCost() : 0;

        // Create the new revenue plan instance
        $revenuePlan = new RevenuePlan();

        try {
            // Set revenue plan properties
            $revenuePlan->budget_project_id = $budgetProject->id;
            $revenuePlan->type = $request->type;
            $revenuePlan->contract = $request->contract;
            $revenuePlan->project = $request->project;
            $revenuePlan->amount = $request->amount;
            $revenuePlan->description = $request->description;

            // Run calculations before saving
            $revenuePlan->calculateTotalProfit();
            $revenuePlan->calculateNetProfitBeforeTax($totalDirectCost, $totalIndirectCost);
            // Perform remaining calculations
            $revenuePlan->calculateTax();
            $revenuePlan->calculateNetProfitAfterTax();
            //$revenuePlan->calculateProfitPercentage();

            // Save the revenue plan data
            $revenuePlan->save();
        } catch (ValidationException $e) {
            // Handle the exception, returning the error messages
            return back()->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            $revenuePlan->delete();
            return back()->withErrors(['profit_error' => $e->getMessage()]);
        }

        return redirect('/pages/edit-project-budget/' . $budgetProject->id)->with('success', 'Revenue added successfully!');
    }
    public function findByReferenceCode(Request $request)
    {
        // Get the reference code from the request
        $referenceCode = $request->input('reference_code');

        // Find the ApprovedBudget by reference_code
        $approvedBudget = ApprovedBudget::where('reference_code', $referenceCode)->first();
        $budgetProject = BudgetProject::where('reference_code', $referenceCode)->first();
        $allocatedBudget = TotalBudgetAllocated::where('reference_code', $referenceCode)->first();

        if (!$approvedBudget) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'No budget found with this reference code']);
        }

        // Pass the budget to the view
        return view('content.pages.pages-allocate-budget', compact('approvedBudget', 'budgetProject', 'allocatedBudget'));
    }

    public function allocateBudgetByFinance(Request $request)
    {
        // Retrieve the budget project by ID
        $budget = BudgetProject::where('id', $request->project)->first();

        // Check if the budget is already allocated
        $allocated = TotalBudgetAllocated::where('reference_code', $budget->reference_code)->first();

        // If allocation exists, redirect back with a success message
        if ($allocated) {
            $errors = ['Budget has already been allocated for this project.', 'Please check the budget details.'];
            return redirect()->back()->withErrors($errors);
        }

        // Validate input to ensure no negative numbers are submitted
        $request->validate([
            'salary_allocation' => 'required|numeric|min:0',
            'facility_allocation' => 'required|numeric|min:0',
            'material_allocation' => 'required|numeric|min:0',
            'overhead_allocation' => 'required|numeric|min:0',
            'financial_allocation' => 'required|numeric|min:0',
            'capital_expenditure_allocation' => 'required|numeric|min:0',
            'approved_salary_allocation' => 'required|numeric|min:0',
            'approved_facility_allocation' => 'required|numeric|min:0',
            'approved_material_allocation' => 'required|numeric|min:0',
            'approved_overhead_allocation' => 'required|numeric|min:0',
            'approved_financial_allocation' => 'required|numeric|min:0',
            'approved_capital_expenditure_allocation' => 'required|numeric|min:0',
            'project' => 'required|exists:budget_project,id',
        ]);

        // Retrieve all allocations from the request
        $allocations = [
            'salary' => [
                'allocated' => $request->input('salary_allocation'),
                'approved' => $request->input('approved_salary_allocation'),
            ],
            'facility' => [
                'allocated' => $request->input('facility_allocation'),
                'approved' => $request->input('approved_facility_allocation'),
            ],
            'material' => [
                'allocated' => $request->input('material_allocation'),
                'approved' => $request->input('approved_material_allocation'),
            ],
            'overhead' => [
                'allocated' => $request->input('overhead_allocation'),
                'approved' => $request->input('approved_overhead_allocation'),
            ],
            'financial' => [
                'allocated' => $request->input('financial_allocation'),
                'approved' => $request->input('approved_financial_allocation'),
            ],
            'Capital Expenditure' => [
                'allocated' => $request->input('capital_expenditure_allocation'),
                'approved' => $request->input('approved_capital_expenditure_allocation'),
            ],
        ];

        // Loop through each allocation and validate if allocated budget exceeds the approved budget
        foreach ($allocations as $type => $budget) {
            if ($budget['allocated'] > $budget['approved']) {
                return back()->withErrors(['error' => "Allocated budget for {$type} cannot exceed approved budget"]);
            }
        }

        // Calculate total allocated budget
        $totalAllocatedBudget = array_sum(array_column($allocations, 'allocated'));

        $budget = BudgetProject::where('id', $request->input('project'))->first();

        // return response()->json($budget);

        // Optionally update the BudgetProject model's total budget allocation
        BudgetProject::where('id', $request->input('project'))->update([
            'total_budget_allocated' => $totalAllocatedBudget,
        ]);

        // Store the allocation in the TotalBudgetAllocated model
        $totalBudget = TotalBudgetAllocated::create([
            'budget_project_id' => $budget->id,
            'total_salary' => $allocations['salary']['allocated'],
            'total_facility_cost' => $allocations['facility']['allocated'],
            'total_material_cost' => $allocations['material']['allocated'],
            'total_cost_overhead' => $allocations['overhead']['allocated'],
            'total_financial_cost' => $allocations['financial']['allocated'],
            'total_capital_expenditure' => $allocations['Capital Expenditure']['allocated'],
            'allocated_budget' => $totalAllocatedBudget,
            'reference_code' => $budget->reference_code,
        ]);

        // Optionally update the BudgetProject model's total budget allocation
        BudgetProject::where('id', $request->input('project'))->update([
            'total_budget_allocated' => $totalAllocatedBudget,
        ]);

        // Iterate through the allocations and save each one to the database
        foreach ($allocations as $category => $allocation) {
            // Create a cash flow entry for each category
            CashFlow::create([
                'date' => now(), // Adjust the date as needed
                'description' => 'Initial Allocation',
                'category' => ucfirst($category), // Capitalize the category name
                'cash_inflow' => $allocation['allocated'],
                'cash_outflow' => 0, // Assuming initial allocation has no outflow
                'reference_code' => $budget->reference_code,
                'committed_budget' => $allocation['allocated'],
                'balance' => $allocation['allocated'], // Balance is equal to the committed budget initially
                'budget_project_id' => $request->input('project'),
                'project_manager' => $budget->manager_id, // Assuming you store the manager ID here
            ]);
        }

        // Return success message or redirect to the appropriate page
        return redirect()
            ->route('budget-project-report-summary', ['id' => $budget->id])
            ->with('success', 'Funds are Allocated for this Project');
    }

    //show cash flow list

    public function cashflowLists(Request $request)
    {
        // Retrieve all Budget Projects for the dropdown
        $budgetProjects = BudgetProject::all();
        $allProjects = Project::all();
        $users = User::all();
        $allocatedBudgets = TotalBudgetAllocated::all();

        // return response($allocatedBudgets);

        // Start a query on the CashFlow model
        $query = CashFlow::query();

        // Apply filters if present in the request
        if ($request->has('reference_code') && $request->reference_code) {
            $query->where('reference_code', 'like', '%' . $request->reference_code . '%');
        }

        if ($request->has('budget_project_id') && $request->budget_project_id) {
            $query->where('budget_project_id', $request->budget_project_id);
        }

        // Execute the query and get the results
        $cashFlows = $query->get();

        // Pass data to the view
        return view('content.pages.pages-show-cashflow-list', compact('cashFlows', 'allocatedBudgets', 'budgetProjects', 'allProjects', 'users'));
    }

    public function showAllocatedBudgets(Request $request)
    {
        $budgetProjects = BudgetProject::all();

        // Fetch budget projects and filter based on query parameters
        $query = TotalBudgetAllocated::query();

        // Apply filters if present in the request
        if ($request->has('reference_code') && $request->reference_code) {
            $query->where('reference_code', 'like', '%' . $request->reference_code . '%');
        }

        if ($request->has('budget_project_id')) {
            $query->where('budget_project_id', $request->input('budget_project_id'));
        }

        // Get the filtered results
        $allocatedBudgets = $query->get();

        // Pass data to the view
        return view('content.pages.pages-show-allocated-budgets', compact('budgetProjects', 'allocatedBudgets'));
    }

    //store capital expense
    public function storeCapex(Request $request)
    {
        // return response($request->all());
        $validated = $request->validate([
            'type' => 'required|string',
            'project' => 'required|exists:projects,id',
            'po' => 'required|string',
            'expense' => 'required|string',
            'other_expense' => 'nullable|string', // Ensure correct naming convention
            'description' => 'required|string',
            'status' => 'nullable|string',
            'total_number' => 'required|numeric',
            'cost' => 'required|nullable',
            'project_id' => 'required|exists:budget_project,id',
        ]);

        // Create a new CapitalExpenditure record
        $capitalExpenditure = new CapitalExpenditure();

        $capitalExpenditure->budget_project_id = $validated['project_id'];
        $capitalExpenditure->type = $validated['type'];
        $capitalExpenditure->project = $validated['project'];
        $capitalExpenditure->po = $validated['po'];
        $capitalExpenditure->expenses = !empty($validated['other_expense']) && $validated['other_expense'] !== 'Other' ? $validated['other_expense'] : $validated['expense'];
        $capitalExpenditure->description = $validated['description'];
        $capitalExpenditure->status = $validated['status'];
        $capitalExpenditure->total_number = $validated['total_number'];
        $capitalExpenditure->cost = floatval($request->cost_hidden);

        // Calculate total cost if necessary
        $capitalExpenditure->calculateTotalCost($capitalExpenditure->budget_project_id);

        // Save the record to the database
        $capitalExpenditure->save();

        return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with('success', 'CAPEX added successfully!');
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

        return redirect('/pages/edit-project-budget/' . $id)->with('success', 'CAPEX added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $budget = BudgetProject::findOrFail($id);
        $budget->delete();

        return redirect('/pages/add-project-budget')->with('success', 'Project Budget Deleted successfully!');
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
