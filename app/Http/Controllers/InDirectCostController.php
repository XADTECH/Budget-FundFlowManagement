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

class InDirectCostController extends Controller
{
  public function storeCostOverhead(Request $request)
  {
    // Return the request data as JSON for debugging purposes
    // You may want to remove this line in production
    //return response()->json($request->all());

    // Validate the incoming request
    $validated = $request->validate([
      'type' => 'required|string',
      'contract' => 'required|string',
      'project' => 'required|exists:projects,id', // Ensure `projects` table exists
      'po' => 'required|string',
      'expense' => 'required|string',
      'cost_per_month' => 'nullable|numeric',
      'description' => 'nullable|string',
      'status' => 'required|string',
      'noOfPerson' => 'required|numeric', // Renamed to `no_of_person`
      'months' => 'required|numeric', // Renamed to `no_of_months`
      'project_id' => 'required|string', // Ensure `budget_projects` table exists
    ]);

    $IndirectCost = InDirectCost::firstOrNew([
      'budget_project_id' => $validated['project_id'],
    ]);

    // If it was not found in the database, create it and save
    if (!$IndirectCost->exists) {
      $IndirectCost->save();
    }

    // Create a new salary record
    $costoverhead = new CostOverhead();
    $costoverhead->in_direct_cost_id = $IndirectCost->id;
    $costoverhead->type = $validated['type'];
    $costoverhead->contract = $validated['contract'];
    $costoverhead->project = $validated['project'];
    $costoverhead->po = $validated['po'];
    $costoverhead->expenses = $validated['expense'];
    $costoverhead->cost_per_month = $validated['cost_per_month'];
    $costoverhead->description = $validated['description'];
    $costoverhead->status = $validated['status'];
    $costoverhead->no_of_staff = $validated['noOfPerson']; // Map to your model attribute
    $costoverhead->no_of_months = $validated['months']; // Map to your model attribute
    $costoverhead->budget_project_id = $validated['project_id']; // Map to your model attribute
    $costoverhead->calculateTotalCost();
    $costoverhead->calculateAverageCost();
    $costoverhead->save();

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
      'contract' => 'required|string',
      'project' => 'required|exists:projects,id', // Ensure `projects` table exists
      'po' => 'required|string',
      'expense' => 'required|string',
      'cost_per_month' => 'nullable|numeric',
      'description' => 'nullable|string',
      'status' => 'required|string',
      'months' => 'required|numeric', // Renamed to `no_of_months`
      'project_id' => 'required|string', // Ensure `budget_projects` table exists
    ]);

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
    $financialcost->contract = $validated['contract'];
    $financialcost->project = $validated['project'];
    $financialcost->po = $validated['po'];
    $financialcost->expenses = $validated['expense'];
    $financialcost->cost_per_month = $validated['cost_per_month'];
    $financialcost->description = $validated['description'];
    $financialcost->status = $validated['status'];
    $financialcost->no_of_months = $validated['months']; // Map to your model attribute
    $financialcost->budget_project_id = $validated['project_id']; // Map to your model attribute
    $financialcost->calculateTotalCost();
    $financialcost->calculateAverageCost();
    $financialcost->save();

    return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with(
      'success',
      'Financial Cost added successfully!'
    );
  }
}
