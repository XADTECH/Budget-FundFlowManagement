<?php

namespace App\Http\Controllers;

use App\Models\PlannedCash;
use App\Models\PlannedCashOpeningBalance;
use Illuminate\Http\Request;

class PlannedCashController extends Controller
{
  public function plancashReport()
  {
    // Fetch the opening balance from the PlannedCashOpeningBalance table
    $openingBalanceRecord = PlannedCashOpeningBalance::first();
    $openingBalance = $openingBalanceRecord ? $openingBalanceRecord->amount : 0;
    $mainopeningBalance = $openingBalanceRecord ? $openingBalanceRecord->amount : 0;

    // Fetch all planned cash records
    $plannedCashRecords = PlannedCash::all();

    // Initialize arrays to hold project details and totals
    $projects = [];
    $totalOpeningBalance = 0;
    $totalPlannedCash = 0;
    $totalReceivedAmount = 0;
    $totalTotalReceived = 0;
    $totalRemainingAmount = 0;

    // Group records by project_id
    $groupedRecords = $plannedCashRecords->groupBy('project_id');

    foreach ($groupedRecords as $projectId => $records) {
      // Initialize variables for each project
      $projectPlannedCash = 0;
      $projectReceivedAmount = 0;

      foreach ($records as $record) {
        // Sum up Planned Cash and Received Amount for each project
        $projectPlannedCash += $record->planned_amount; // Sum up for all records
        $projectReceivedAmount += $record->received_amount; // Sum up for all records
      }

      // Calculate total received and remaining balance for the project
      $totalReceived = $projectReceivedAmount; // Total Received is the Received Amount
      $remainingAmount = $openingBalance + $projectPlannedCash - $totalReceived; // Calculation

      // Add project details to the projects array
      $projects[] = [
        'Project' => $projectId,
        'Opening Balance' => $mainopeningBalance,
        'Planned Cash' => $projectPlannedCash,
        'Received Amount' => $projectReceivedAmount,
        'Total Received' => $totalReceived,
        'Remaining Amount' => $remainingAmount,
      ];

      // Update totals
      $totalOpeningBalance += $openingBalance;
      $totalPlannedCash += $projectPlannedCash;
      $totalReceivedAmount += $projectReceivedAmount;
      $totalTotalReceived += $totalReceived;
      $totalRemainingAmount += $remainingAmount;

      // Update the opening balance for the next project
      $openingBalance = $remainingAmount;
    }

    // Prepare the final response
    $response = [
      'Projects' => $projects,
      'Totals' => [
        'Opening Balance' => $mainopeningBalance,
        'Planned Cash' => $totalPlannedCash,
        'Received Amount' => $totalReceivedAmount,
        'Total Received' => $totalTotalReceived,
        'Remaining Amount' => $totalRemainingAmount,
      ],
    ];

    // return response()->json($projects);
    return view('content.pages.pages-planned-cash-report', compact('projects'));
  }

  //get cash receive amount
  public function cashreceiveAmount(Request $request)
  {
    return view('content.pages.pages-add-cash-receive');
  }

  //post add cash receive
  public function addcashreceiveAmount(Request $request)
  {
    try {
      // Validate the request data
      $validatedData = $request->validate([
        'project_id' => 'required|numeric',
        'cashreceived' => 'required|numeric',
      ]);

      // Check if a cash plan with a planned amount exists for the given project
      $existingPlan = PlannedCash::where('project_id', $validatedData['project_id'])
        ->whereNotNull('planned_amount')
        ->first();

      if (!$existingPlan) {
        // Respond with a message if no planned amount exists for this project
        return response()->json(['message' => 'Please enter planned amount first'], 400);
      }

      // Create a new PlannedCash record for the cash received
      $plannedCash = new PlannedCash();
      $plannedCash->project_id = $validatedData['project_id'];
      $plannedCash->received_amount = $validatedData['cashreceived'];
      $plannedCash->save();

      return response()->json(['success' => 'Cash Received Entered Successfully']);
    } catch (Exception $e) {
      return response()->json(['message' => 'Internal Server Error']);
    }
  }

  //add plan cash amount
  public function addcashplanAmount(Request $request)
  {
    // Validate and process the request data
    $validatedData = $request->validate([
      'project_id' => 'required|numeric',
      'plancash' => 'required|numeric',
    ]);

    // Check if a cash plan already exists for the given project
    $existingPlan = PlannedCash::where('project_id', $validatedData['project_id'])->first();

    if ($existingPlan) {
      // Return the existing planned amount
      return response()->json([
        'message' => 'Cash plan already exists for this project.',
        'existing_amount' => $existingPlan->planned_amount,
      ]);
    }

    // Create a new cash plan if none exists
    $plannedCash = new PlannedCash();
    $plannedCash->project_id = $validatedData['project_id'];
    $plannedCash->planned_amount = $validatedData['plancash'];
    $plannedCash->save();

    if ($plannedCash) {
      return response()->json([
        'success' => 'Plan Cash Entered Successfully',
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error 500',
      ]);
    }
  }

  //store opening balance
  public function storeOpeningBalance(Request $request)
  {
    // Validate and process the request data
    $validatedData = $request->validate([
      'openingbalance' => 'required|numeric',
    ]);

    // Process the opening balance
    $openingBalance = $validatedData['openingbalance'];
    // Save or use the data as needed

    $existingRecord = PlannedCashOpeningBalance::where('amount', '>', 0)->first();

    if ($existingRecord) {
      return response()->json([
        'message' => 'Opening Balance Already Exists',
      ]);
    }
    // return response()->json('hi');

    // Create a new PlannedCash instance and set the opening balance
    $plannedCash = new PlannedCashOpeningBalance();
    $plannedCash->amount = $openingBalance;

    // Save the new record
    $plannedCash->save();

    return response()->json([
      'success' => 'Amount Entered Successfully',
    ]);

    return response()->json(['success' => 'Amount Entered']);
  }

  //get opening balance
  public function getopeningBalance(Request $request)
  {
    // Assuming you want to get the opening balance of the first PlannedCash record
    $plannedCash = PlannedCashOpeningBalance::first();

    // Check if a record exists
    if ($plannedCash) {
      return response()->json(['opening_balance' => $plannedCash->amount]);
    } else {
      return response()->json(['message' => 'No record found'], 404);
    }
  }

  //add balance view form
  public function addBalance(Request $request)
  {
    return view('content.pages.pages-add-opening-balance-amount');
  }

  //allocate cash view form
  public function allocateCash(Request $request)
  {
    return view('content.pages.pages-allocate-cash');
  }

  // Display a listing of the planned cash entries
  public function index()
  {
    $plannedCashEntries = PlannedCash::with('project')->get();
    return view('planned_cash.index', compact('plannedCashEntries'));
  }

  // Show the form for creating a new planned cash entry
  public function create()
  {
    return view('planned_cash.create');
  }

  // Store a newly created planned cash entry in storage
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'project_id' => 'required|exists:projects,id',
      'planned_amount' => 'required|numeric',
      'received_amount' => 'required|numeric',
    ]);

    PlannedCash::create($validatedData);

    return redirect()
      ->route('planned_cash.index')
      ->with('success', 'Planned Cash entry created successfully!');
  }

  // Display the specified planned cash entry
  public function show(PlannedCash $plannedCash)
  {
    return view('planned_cash.show', compact('plannedCash'));
  }

  // Show the form for editing the specified planned cash entry
  public function edit(PlannedCash $plannedCash)
  {
    return view('planned_cash.edit', compact('plannedCash'));
  }

  // Update the specified planned cash entry in storage
  public function update(Request $request, PlannedCash $plannedCash)
  {
    $validatedData = $request->validate([
      'project_id' => 'required|exists:projects,id',
      'opening_balance' => 'required|numeric',
      'planned_amount' => 'required|numeric',
      'received_amount' => 'required|numeric',
    ]);

    $plannedCash->update($validatedData);

    return redirect()
      ->route('planned_cash.index')
      ->with('success', 'Planned Cash entry updated successfully!');
  }

  // Remove the specified planned cash entry from storage
  public function destroy(PlannedCash $plannedCash)
  {
    $plannedCash->delete();
    return redirect()
      ->route('planned_cash.index')
      ->with('success', 'Planned Cash entry deleted successfully!');
  }
}
