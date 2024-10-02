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
        //return response()->json($request->all());

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
        $redirect = false;
        if ($request->isajax == 'false') {
            $redirect = true;
        }
        $salary = Salary::findOrFail($id);
        $salary->update($request->all());
        $salary->calculateTotalCost();
        $salary->calculateAverageCost();

        if ($redirect) {
            return redirect()->back()->with('success', "Record Updated Sucessfully");
        } else {

            return response()->json(['success' => true]);
        }
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
        $facility->calculateTotalCost();
        $facility->calculateAverageCost();;
        return response()->json(['success' => true]);
    }

    // MaterialCostController
    public function getMaterialData($id)
    {
        try {
            // First, try to find the material cost
            $materialCost = MaterialCost::find($id);

            if ($materialCost) {
                return response()->json([
                    'id' => $materialCost->id,
                    'type' => $materialCost->type,
                    'project' => $materialCost->project,
                    'po' => $materialCost->po,
                    'expense' => 'consumed_material',
                    'material_head' => $materialCost->expenses,
                    'quantity' => $materialCost->quantity,
                    'unit' => $materialCost->unit,
                    'unit_cost' => $materialCost->unit_cost,
                    'description' => $materialCost->description,
                    'status' => $materialCost->status,
                    'total_cost' => $materialCost->total_cost,
                    'average_cost' => $materialCost->average_cost,
                    'percentage_cost' => $materialCost->percentage_cost,
                ]);
            }

            // If not found, try to find petty cash
            $pettyCash = PettyCash::find($id);
            if ($pettyCash) {
                return response()->json([
                    'id' => $pettyCash->id,
                    'type' => 'Material', // Assuming this is always 'Material' for petty cash
                    'project' => $pettyCash->project_id,
                    'po' => null, // Assuming petty cash doesn't have a PO
                    'expense' => 'petty_cash',
                    'petty_cash_amount' => $pettyCash->amount,
                    'description' => $pettyCash->description,
                ]);
            }

            // If not found, try to find NOC payment
            $nocPayment = NocPayment::find($id);
            if ($nocPayment) {
                return response()->json([
                    'id' => $nocPayment->id,
                    'type' => 'Material', // Assuming this is always 'Material' for NOC payment
                    'project' => $nocPayment->project_id,
                    'po' => null, // Assuming NOC payment doesn't have a PO
                    'expense' => 'noc_payment',
                    'noc_amount' => $nocPayment->amount,
                    'description' => $nocPayment->description,
                ]);
            }

            // If no record is found
            return response()->json(['error' => 'Record not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateMaterial(Request $request, $id)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'type' => 'required|string',
                'project' => 'required|exists:projects,id',
                'po' => 'required|string',
                'expense' => 'required|string',
                'project_id' => 'required|exists:budget_project,id',

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

            if ($validated['expense'] === 'consumed_material') {
                $materialCost = MaterialCost::findOrFail($id);
                $materialCost->expenses = $validated['material_head'];
                $materialCost->quantity = $validated['quantity'];
                $materialCost->unit = $validated['unit'];
                $materialCost->unit_cost = $validated['unit_cost'];
                $materialCost->description = $validated['description'];
                $materialCost->status = $validated['status'];
                $materialCost->project = $validated['project'];
                $materialCost->type = $validated['type'];
                $materialCost->po = $validated['po'];

                // Recalculate total and average cost
                $materialCost->calculateTotalCost();
                $materialCost->calculateAverageCost();
                $materialCost->calculateAverageCostPercentage();

                // Save the updated material cost
                $materialCost->save();

                return response()->json(['success' => true, 'message' => 'Material Cost updated successfully!']);
            } elseif ($validated['expense'] === 'petty_cash') {
                $pettyCash = PettyCash::where('project_id', $validated['project_id'])->firstOrFail();

                // Check if the new amount is different from the existing one
                if ($pettyCash->amount != $validated['petty_cash_amount']) {
                    $existingPettyCash = PettyCash::where('project_id', $validated['project_id'])
                        ->where('amount', $validated['petty_cash_amount'])
                        ->where('id', '!=', $pettyCash->id)
                        ->first();

                    if ($existingPettyCash) {
                        return response()->json(['success' => false, 'message' => 'Amount already exists for this project.'], 422);
                    }
                }

                $pettyCash->amount = $validated['petty_cash_amount'];
                $pettyCash->save();

                return response()->json(['success' => true, 'message' => 'Petty Cash updated successfully!']);
            } elseif ($validated['expense'] === 'noc_payment') {
                $nocPayment = NocPayment::where('project_id', $validated['project_id'])->firstOrFail();

                // Check if the new amount is different from the existing one
                if ($nocPayment->amount != $validated['noc_amount']) {
                    $existingNocPayment = NocPayment::where('project_id', $validated['project_id'])
                        ->where('amount', $validated['noc_amount'])
                        ->where('id', '!=', $nocPayment->id)
                        ->first();

                    if ($existingNocPayment) {
                        return response()->json(['success' => false, 'message' => 'Amount already exists for this project.'], 422);
                    }
                }

                $nocPayment->amount = $validated['noc_amount'];
                $nocPayment->save();

                return response()->json(['success' => true, 'message' => 'NOC Payment updated successfully!']);
            }

            return response()->json(['success' => false, 'message' => 'Invalid expense type.'], 422);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteSalary(Request $request)
    {
        try {
            // Validate that project_id is provided
            $redirect = false;
            if ($request->isajax == 'false') {
                $redirect = true;
            }
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
            if ($redirect) {
                return redirect()->back()->with('success', "Record Updated Sucessfully");
            } else {
                return response()->json(['success' => 'Deleted successfully']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the project record.'], 500);
        }
    }
    public function deleteFacilities(Request $request)
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
            $project = FacilityCost::find($request->input('id'));

            if (!$project) {
                return response()->json(['message' => ' record not found.'], 404);
            }

            // Delete the project record
            $project->delete();

            return response()->json(['success' => ' eleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the project record.'], 500);
        }
    }

    public function deleteMaterial(Request $request)
    {

        try {
            $id = $request->input('id');
            // First, try to find and delete the material cost
            $materialCost = MaterialCost::find($id);
            if ($materialCost) {
                $materialCost->delete();
                return response()->json(['success' => true, 'message' => 'Material Cost deleted successfully.']);
            }

            // If not found, try to find and delete petty cash
            $pettyCash = PettyCash::find($id);
            if ($pettyCash) {
                $pettyCash->delete();
                return response()->json(['success' => true, 'message' => 'Petty Cash record deleted successfully.']);
            }

            // If not found, try to find and delete NOC payment
            $nocPayment = NocPayment::find($id);
            if ($nocPayment) {
                $nocPayment->delete();
                return response()->json(['success' => true, 'message' => 'NOC Payment record deleted successfully.']);
            }

            // If no record is found
            return response()->json(['success' => 'User deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the record: ' . $e->getMessage()], 500);
        }
    }
}
