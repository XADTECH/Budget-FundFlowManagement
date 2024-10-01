<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\DirectCost;
use App\Models\InDirectCost;
use App\Models\FacilityCost;
use App\Models\MaterialCost;
use App\Models\CostOverhead;
use App\Models\FinancialCost;
use Exception;
use Illuminate\Support\Facades\Validator;

class InDirectCostController extends Controller
{
  public function storeCostOverhead(Request $request)
  {
    // Return the request data as JSON for debugging purposes (remove in production)
    //return response()->json($request->all());

    // Validate the incoming request
    $validated = $request->validate([
      'type' => 'required|string',
      'project' => 'required|exists:projects,id', // Ensure `projects` table exists
      'po' => 'required|string',
      'expense' => 'required|string',
      'other_expense' => 'nullable|String',
      'amount' => 'required|numeric', // Corrected to `numeric`
      'project_id' => 'required|string', // Ensure `budget_projects` table exists
    ]);

    // Retrieve or create an InDirectCost
    $indirectCost = InDirectCost::firstOrNew([
      'budget_project_id' => $validated['project_id'],
    ]);

    // Save if it's a new entry
    if (!$indirectCost->exists) {
      $indirectCost->save();
    }

    // return response($validated['expense']);

    // Assuming you have a method to check if the value exists
    $existingValue = CostOverhead::where('budget_project_id', $validated['project_id'])
      ->where('expenses', $validated['expense'])
      ->first();

    if ($existingValue) {
      return redirect('/pages/edit-project-budget/' . $validated['project_id'])
        ->withErrors(['error' => 'This expense head already has a value!']);
    }

    // Create a new CostOverhead record
    $costOverhead = new CostOverhead();
    $costOverhead->in_direct_cost_id = $indirectCost->id;
    $costOverhead->type = $validated['type'];
    $costOverhead->project = $validated['project'];
    $costOverhead->po = $validated['po'];
    $costOverhead->expenses = $validated['other_expense'] ?? $validated['expense'];
    $costOverhead->amount = $validated['amount'];
    $costOverhead->budget_project_id = $validated['project_id'];
    $costOverhead->amount = $costOverhead->calculateBasedOnExpenseHead();
    $costOverhead->save();

    return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with(
      'success',
      'Cost Overhead added successfully!'
    );
  }


  public function storeFinancialCost(Request $request)
  {
    // Return the request data as JSON for debugging purposes
    // You may want to remove this line in production
    //return response()->json($request->all());

    // Validate the incoming request
    $validated = $request->validate([
      'type' => 'required|string',
      'project' => 'required|exists:projects,id', // Ensure `projects` table exists
      'po' => 'required|string',
      'expense' => 'required|string',
      'amount' => 'required|numeric|min:0|max:45', // Ensure the amount is between 0 and 45
      'project_id' => 'required|string', // Ensure `budget_projects` table exists
    ]);

    // Check if the expense for Risk or Financial Cost already exists for this budget_project_id
    $existingExpense = FinancialCost::where('in_direct_cost_id', $validated['project_id'])
      ->where('expenses', $validated['expense'])
      ->exists();

    if ($existingExpense) {
      // Return error if the same expense already exists
      return redirect()->back()->withErrors(['expense' => 'The ' . $validated['expense'] . ' amount is already entered for this project.']);
    }

    $IndirectCost = InDirectCost::firstOrNew([
      'budget_project_id' => $validated['project_id'],
    ]);

    // If it was not found in the database, create it and save
    if (!$IndirectCost->exists) {
      $IndirectCost->save();
    }

    // Create a new salary record
    $financialcost = new FinancialCost();
    $financialcost->in_direct_cost_id = $IndirectCost->id;
    $financialcost->type = $validated['type'];
    $financialcost->project = $validated['project'];
    $financialcost->po = $validated['po'];
    $financialcost->expenses = $validated['expense'];
    $financialcost->total_cost = $validated['amount'];
    $financialcost->percentage = $validated['amount'];
    $financialcost->budget_project_id = $validated['project_id'];
    $financialcost->total_cost = $financialcost->calculateTotalCost($validated['project_id']);

    $financialcost->save();

    return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with(
      'success',
      'Financial Cost added successfully!'
    );
  }
  public function updateFinancial(Request $request, $id)
  {

    $validated = $request->validate([
      'type' => 'required|string',
      'project' => 'required|exists:projects,id', // Ensure `projects` table exists
      'po' => 'required|string',
      'expenses' => 'required|string',
      'amount' => 'required|numeric|min:0|max:45', // Ensure the amount is between 0 and 45
      'budget_project_id' => 'required|string', // Ensure `budget_projects` table exists
    ]);

    $financialcost = FinancialCost::findOrFail($id);
    $financialcost->type = $validated['type'];
    $financialcost->project = $validated['project'];
    $financialcost->po = $validated['po'];
    $financialcost->expenses = $validated['expenses'];
    $financialcost->total_cost = $validated['amount'];
    $financialcost->percentage = $validated['amount'];
    $financialcost->budget_project_id = $validated['budget_project_id'];
    $financialcost->total_cost = $financialcost->calculateTotalCost($validated['budget_project_id']);
    $financialcost->update();

    return response()->json(['success' => true]);
  }



  public function getCostOverHeadData($id)
  {
    $salary = CostOverhead::findOrFail($id);
    return response()->json($salary);
  }
  public function getFinancialData($id)
  {
    $salary = FinancialCost::findOrFail($id);
    return response()->json($salary);
  }

  public function updateCostOverhead(Request $request, $id)
  {
    $validated = $request->validate([
      'type' => 'required|string',
      'project' => 'required|exists:projects,id', // Ensure `projects` table exists
      'po' => 'required|string',
      'expenses' => 'required|string',
      'other_expense' => 'nullable|String',
      'amount' => 'required|numeric', // Corrected to `numeric`
      'budget_project_id' => 'required|string', // Ensure `budget_projects` table exists
    ]);
    $indirectCost = InDirectCost::firstOrNew([
      'budget_project_id' => $validated['budget_project_id'],
    ]);

    // Save if it's a new entry
    if (!$indirectCost->exists) {
      $indirectCost->save();
    }

    // Assuming you have a method to check if the value exists

    // dd($request->all());
    $costOverhead = CostOverhead::findOrFail($id);
    $costOverhead->type = $validated['type'];
    $costOverhead->project = $validated['project'];
    $costOverhead->po = $validated['po'];
    $costOverhead->expenses = $validated['other_expense'] ?? $validated['expense'];
    $costOverhead->amount = $validated['amount'];
    $costOverhead->budget_project_id = $validated['budget_project_id'];
    $costOverhead->amount = $costOverhead->calculateBasedOnExpenseHead();
    $costOverhead->update();

    return response()->json(['success' => true]);
  }

  public function deleteCostOverHead(Request $request)
  {
    try {
      // Validate that project_id is provided
      $validator = Validator::make($request->all(), [
        'id' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      // Find the project record by ID
      $project = CostOverhead::find($request->input('id'));

      if (!$project) {
        return response()->json(['message' => ' record not found.'], 404);
      }

      // Delete the project record
      $project->delete();

      return response()->json(['success' => 'Cost Overhead deleted successfully']);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred while deleting the project record.'], 500);
    }
  }
  public function deleteFinancial(Request $request)
  {
    try {
      // Validate that project_id is provided
      $validator = Validator::make($request->all(), [
        'id' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      // Find the project record by ID
      $project = FinancialCost::find($request->input('id'));

      if (!$project) {
        return response()->json(['message' => ' record not found.'], 404);
      }

      // Delete the project record
      $project->delete();

      return response()->json(['success' => 'Record Deleted successfully']);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred while deleting the project record.'], 500);
    }
  }
}
