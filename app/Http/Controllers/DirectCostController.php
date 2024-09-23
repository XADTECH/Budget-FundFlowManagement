<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\DirectCost;
use App\Models\FacilityCost;
use App\Models\PettyCash;
use App\Models\NocPayment;
use App\Models\MaterialCost;
use Exception;
use Illuminate\Support\Facades\Validator;

class DirectCostController extends Controller
{
    public function storeSalary(Request $request)
    {
        //return response()->json($request->all());
        // Validate the incoming request
        $validated = $request->validate([
            'type' => 'required|string',
            'project' => 'required|exists:projects,id', // Ensure `projects` table exists
            'po' => 'required|string',
            'expense' => 'required|string',
            'cost_per_month' => 'nullable|numeric',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'noOfPerson' => 'required|numeric', // Number of persons
            'months' => 'required|numeric', // Number of months

            'project_id' => 'required|exists:budget_project,id', // Ensure `budget_projects` table exists
            'other_expense' => 'nullable|string', // For other types of expenses
            'visa_status' => 'nullable|string', // For visa status
        ]);

        // Ensure DirectCost record exists or create a new one
        $directCost = DirectCost::firstOrNew([
            'budget_project_id' => $validated['project_id'],
        ]);

        if (!$directCost->exists) {
            $directCost->save();
        }

        // Create a new Salary record
        $salary = new Salary();
        $salary->direct_cost_id = $directCost->id;
        $salary->type = $validated['type'];
        $salary->project = $validated['project'];
        $salary->po = $validated['po'];

        // Set the `expenses` field based on `other_expense`
        $salary->expenses = $validated['other_expense'] ?? $validated['expense'];

        $salary->cost_per_month = $validated['cost_per_month'];
        $salary->description = $validated['description'];
        $salary->status = $validated['status'];
        $salary->no_of_staff = $validated['noOfPerson']; // Map to your model attribute
        $salary->no_of_months = $validated['months']; // Map to your model attribute
        $salary->overseeing_sites = $request->overseeing_sites ?? 0;
        $salary->budget_project_id = $validated['project_id']; // Map to your model attribute
        $salary->visa_status = $validated['visa_status']; // Set visa status

        // Calculate total and average cost
        $salary->calculateTotalCost();
        $salary->calculateAverageCost();

        // Save the salary record
        $salary->save();

        // Update the budget for the project
        // $salary->updateBudget("Salary");

        // Recalculate the total direct cost for the project
        $cost = $directCost->calculateTotalDirectCost();

        // Redirect back to the edit page with a success message
        return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with('success', 'Salary added successfully!');
    }

    public function storeFacility(Request $request)
    {
        // return response()->json($request->all());

        // Validate the incoming request
        $validated = $request->validate([
            'type' => 'required|string',
            'project' => 'required|exists:projects,id',
            'po' => 'required|string',
            'expense' => 'required|string',
            'cost_per_month' => 'nullable|numeric',
            'description' => 'required|string',
            'status' => 'required|string',
            'other_expense' => 'nullable|string', // For other types of expenses
            'months' => 'required|numeric', // Renamed to `no_of_months`
            'project_id' => 'required|string',
        ]);

        $directCost = DirectCost::firstOrNew([
            'budget_project_id' => $validated['project_id'],
        ]);

        // If it was not found in the database, create it and save
        if (!$directCost->exists) {
            $directCost->save();
        }

        // Create a new facility cost record
        $facility = new FacilityCost();
        $facility->direct_cost_id = $directCost->id;
        $facility->type = $validated['type'];
        $facility->project = $validated['project'];
        $facility->po = $validated['po'];
        $facility->expenses = $validated['other_expense'] ?? $validated['expense'];
        $facility->cost_per_month = $validated['cost_per_month'];
        $facility->description = $validated['description'];
        $facility->status = $validated['status'];
        $facility->no_of_staff = $request->noOfPerson; // Map to your model attribute
        $facility->no_of_months = $validated['months'];
        $facility->budget_project_id = $validated['project_id'];

        $facility->calculateTotalCost();
        $facility->calculateAverageCost();
        // $facility->calculatePercentageCost();
        $facility->save();

        // Update total direct cost
        $cost = $directCost->calculateTotalDirectCost();

        // Redirect back to the edit page with a success message
        return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with('success', 'Facility Cost added successfully!');
    }

    public function storeMaterial(Request $request)
    {
        try {

            // return response()->json($request->all());
            // Validate the incoming request
            $validated = $request->validate([
                'type' => 'required|string',
                'project' => 'required|exists:projects,id', // Ensure `projects` table exists
                'po' => 'required|string',
                'expense' => 'required|string',
                'project_id' => 'required|exists:budget_project,id', // Ensure `budget_projects` table exists

                'material_head' => 'string|nullable',
                'quantity' => 'numeric|nullable',
                'unit' => 'string|nullable',
                'unit_cost' => 'numeric|nullable',
                'description' => 'nullable|string',
                'status' => 'string|nullable',

                // Field for petty cash expense type
                'petty_cash_amount' => 'numeric|nullable',

                // Field for NOC payment expense type
                'noc_amount' => 'numeric|nullable',
            ]);

            // Find or create a new DirectCost for the project
            $directCost = DirectCost::firstOrNew([
                'budget_project_id' => $validated['project_id'],
            ]);

            // If DirectCost was not found, create it and save
            if (!$directCost->exists) {
                $directCost->save();
            }

            // Conditionally store fields based on the expense type
            if ($validated['expense'] === 'consumed_material') {
                $materialCost = new MaterialCost();
                $materialCost->expenses = $validated['material_head'];
                $materialCost->quantity = $validated['quantity'];
                $materialCost->unit = $validated['unit'];
                $materialCost->unit_cost = $validated['unit_cost'];
                $materialCost->description = $validated['description'];
                $materialCost->status = $validated['status'];
                $materialCost->direct_cost_id = $directCost->id; // Foreign key reference
                $materialCost->budget_project_id = $validated['project_id']; // Budget project ID
                $materialCost->project = $validated['project']; // Set project field
                $materialCost->type = $validated['type'];
                $materialCost->po = $validated['po'];

                // Create a new MaterialCost record

                // Calculate total and average cost
                $materialCost->calculateTotalCost();
                $materialCost->calculateAverageCost();
                $materialCost->calculateAverageCostPercentage();

                // Save the material cost
                $materialCost->save();

                // Redirect back to the edit page with a success message
                return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with('success', 'Material Cost added successfully!');
            } elseif ($validated['expense'] === 'petty_cash') {
                // Check if the petty cash amount already exists for the project
                $existingPettyCash = PettyCash::where('project_id', $validated['project_id'])
                    ->where('amount', $validated['petty_cash_amount'])
                    ->first();

                if ($existingPettyCash) {
                    return redirect('/pages/edit-project-budget/' . $validated['project_id'])->withErrors(['amount' => 'Amount already exists for this project.']);
                }

                PettyCash::create([
                    'project_id' => $validated['project_id'],
                    'description' => 'Amount for Petty Cash',
                    'amount' => $validated['petty_cash_amount'],
                ]);

                return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with('success', 'Petty Cash added successfully!');
            } elseif ($validated['expense'] === 'noc_payment') {
                // Check if the NOC amount already exists for the project
                $existingNocPayment = NocPayment::where('project_id', $validated['project_id'])
                    ->where('amount', $validated['noc_amount'])
                    ->first();

                if ($existingNocPayment) {
                    return redirect('/pages/edit-project-budget/' . $validated['project_id'])->withErrors(['amount' => 'Amount already exists for this project.']);
                }

                NocPayment::create([
                    'project_id' => $validated['project_id'],
                    'description' => 'Amount for NOC Payment',
                    'amount' => $validated['noc_amount'],
                ]);

                return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with('success', 'NOC Payment added successfully!');
            }
        } catch (Exception $e) {
            return redirect('/pages/edit-project-budget/' . $validated['project_id'])->with('message', $e->getMessage());
        }
    }


    public function getSalaryData($id)
    {
        $salary = Salary::findOrFail($id);
        return response()->json($salary);
    }

    public function updateSalary(Request $request, $id)
    {
        $salary = Salary::findOrFail($id);
        $salary->update($request->all());
        $salary->calculateTotalCost();
        $salary->calculateAverageCost();
        return response()->json(['success' => true]);
    }

    // FacilityCostController
    public function getFacilityData($id)
    {
        $facility = FacilityCost::findOrFail($id);
        return response()->json($facility);
    }

    public function updateFacility(Request $request, $id)
    {
        $facility = FacilityCost::findOrFail($id);
        $facility->update($request->all());
        return response()->json(['success' => true]);
    }

    // MaterialCostController
    public function getMaterialData($id)
    {
        $material = MaterialCost::findOrFail($id);
        return response()->json($material);
    }

    public function updateMaterial(Request $request, $id)
    {
        $material = MaterialCost::findOrFail($id);
        $material->update($request->all());
        return response()->json(['success' => true]);
    }


    public function deleteSalary(Request $request)
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
            $project = Salary::find($request->input('id'));

            if (!$project) {
                return response()->json(['message' => ' record not found.'], 404);
            }

            // Delete the project record
            $project->delete();

            return response()->json(['success' => 'User deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the project record.'], 500);
        }
    }
}
