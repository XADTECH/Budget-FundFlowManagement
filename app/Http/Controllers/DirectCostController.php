<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\DirectCost;
use App\Models\FacilityCost;
use App\Models\MaterialCost;
use Illuminate\Support\Facades\Validator;


class DirectCostController extends Controller
{
    public function storeSalary(Request $request)
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

      $directCost = DirectCost::firstOrNew([
        'budget_project_id' => $validated['project_id'],
      ]);

      // If it was not found in the database, create it and save
      if (!$directCost->exists) {
        $directCost->save();
      }

      // Create a new salary record
      $salary = new Salary();
      $salary->direct_cost_id = $directCost->id;
      $salary->type = $validated['type'];
      $salary->contract = $validated['contract'];
      $salary->project = $validated['project'];
      $salary->po = $validated['po'];
      $salary->expenses = $validated['expense'];
      $salary->cost_per_month = $validated['cost_per_month'];
      $salary->description = $validated['description'];
      $salary->status = $validated['status'];
      $salary->no_of_staff = $validated['noOfPerson']; // Map to your model attribute
      $salary->no_of_months = $validated['months']; // Map to your model attribute
      $salary->budget_project_id = $validated['project_id']; // Map to your model attribute
      $salary->calculateTotalCost();
      $salary->calculateAverageCost();
      $salary->updateBudget("Salary");
      $salary->save();

      $cost = $directCost->calculateTotalDirectCost();

      //return response()->json($cost);

      // Redirect back to the edit page with a success message
      return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with(
        'success',
        'Salary added successfully!'
      );
    }
    public function storeFacility(Request $request)
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
        'description' => 'required|string',
        'status' => 'required|string',
        'months' => 'required|numeric', // Renamed to `no_of_months`
        'project_id' => 'required|string', // Ensure `budget_projects` table exists
      ]);

      $directCost = DirectCost::firstOrNew([
        'budget_project_id' => $validated['project_id'],
      ]);

      // If it was not found in the database, create it and save
      if (!$directCost->exists) {
        $directCost->save();
      }

      // Create a new salary record
      $salary = new FacilityCost();
      $salary->direct_cost_id = $directCost->id;
      $salary->type = $validated['type'];
      $salary->contract = $validated['contract'];
      $salary->project = $validated['project'];
      $salary->po = $validated['po'];
      $salary->expenses = $validated['expense'];
      $salary->cost_per_month = $validated['cost_per_month'];
      $salary->description = $validated['description'];
      $salary->status = $validated['status'];
      $salary->no_of_staff = $request->noOfPerson; // Map to your model attribute
      $salary->no_of_months = $validated['months']; // Map to your model attribute
      $salary->budget_project_id = $validated['project_id']; // Map to your model attribute
      $salary->calculateTotalCost();
      $salary->calculateAverageCost();
      $salary->save();

      $cost = $directCost->calculateTotalDirectCost();

      //return response()->json($cost);

      // Redirect back to the edit page with a success message
      return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with(
        'success',
        'Facility Cost added successfully!'
      );
    }
  
      public function storeMaterial(Request $request)
    {
       try{
                  // Validate the incoming request
            $validated = $request->validate([
              'type' => 'required|string',
              'contract' => 'required|string',
              'project' => 'required|exists:projects,id', // Ensure `projects` table exists
              'po' => 'required|string',
              'expense' => 'required|string',
              'quantity' => 'required|numeric', // Ensure quantity is present
              'unit' => 'required|string', // Ensure unit is present
              'unit_cost' => 'required|numeric', // Ensure unit cost is present
              'description' => 'nullable|string',
              'status' => 'required|string',
              'project_id' => 'required|exists:budget_project,id', // Ensure `budget_projects` table exists
          ]);

          $directCost = DirectCost::firstOrNew([
              'budget_project_id' => $validated['project_id'],
          ]);

          // If it was not found in the database, create it and save
          if (!$directCost->exists) {
              $directCost->save();
          }

          // Create a new material cost record
          $materialCost = new MaterialCost();
          $materialCost->direct_cost_id = $directCost->id; // Foreign key reference
          $materialCost->budget_project_id = $validated['project']; // Project name
          $materialCost->type = $validated['type'];
          $materialCost->project = $validated['project'];
          $materialCost->po = $validated['po'];
          $materialCost->expenses = $validated['expense'];
          $materialCost->quantity = $validated['quantity']; // Quantity of material
          $materialCost->unit = $validated['unit']; // Unit of measurement
          $materialCost->unit_cost = $validated['unit_cost']; // Cost per unit
          $materialCost->description = $validated['description'];
          $materialCost->status = $validated['status'];
          $materialCost->budget_project_id = $validated['project_id']; // Budget project ID
          $materialCost->calculateTotalCost(); // Calculate total cost
          $materialCost->calculateAverageCost(); // Calculate average cost
          $materialCost->save();

          // Redirect back to the edit page with a success message
          return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with(
              'success',
              'Material Cost added successfully!'
          );
       }catch (Exception $e) {
          return redirect('/pages/edit-project-budget/' . $validated['project_id'])
              ->with('message', $e->getMessage());
      }
    }

}
