<?php

namespace App\Http\Controllers;

use App\Models\BusinessClient;
use App\Models\BudgetProject;
use App\Models\BusinessUnit;
use App\Models\User;
use App\Models\Project;
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
  public function create()
  {
    //
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
  public function edit(string $id)
  {
    //
  }

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
