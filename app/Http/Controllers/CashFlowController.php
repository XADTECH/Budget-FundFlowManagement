<?php

namespace App\Http\Controllers;
use App\Models\BudgetProject;
use App\Models\CashFlow;
use App\Models\TotalBudgetAllocated;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    //
    // Show the form to create a cash flow entry
    public function create()
    {
        $budgetProjects = BudgetProject::all();

        return view('content.pages.page-cashflow-form', compact('budgetProjects')); // Name of your Blade view for the form
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'date' => 'required|date',
            'description' => 'required|string',
            'category' => 'required|string',
            'cash_outflow' => 'nullable|numeric', // Allow null for outflow
            'cash_inflow' => 'nullable|numeric', // Allow null for inflow
            'budget_project_id' => 'required|integer',
        ]);

        // Fetch the last recorded cash flow for this project and category
        $lastCashFlow = CashFlow::where('budget_project_id', $request->budget_project_id)
            ->where('category', $request->category)
            ->orderBy('date', 'desc')
            ->first();

        // Calculate the initial balance
        $balance = $lastCashFlow ? $lastCashFlow->balance : 0;

        // Get the allocated budget for the project and category
        $allocatedBudgetEntry = TotalBudgetAllocated::where('budget_project_id', $request->budget_project_id)->first();

        if (!$allocatedBudgetEntry) {
            return redirect()
                ->back()
                ->withErrors(['budget_not_found' => 'No allocated budget found for this project.'])
                ->withInput();
        }

        // Assuming there is a method to get the total allocated budget for the specific category
        $allocatedBudget = $this->getCategoryBudget($allocatedBudgetEntry, $request->category);
        

        // Handle cash outflow
        if ($request->cash_outflow > 0) {
            // Check if there's enough budget for the cash outflow
            if ($request->cash_outflow > $allocatedBudget) {
                return redirect()
                    ->back()
                    ->withErrors(['insufficient_budget' => 'Insufficient budget for this cash outflow transaction.'])
                    ->withInput();
            }
            //   return response($lastCashFlow);
            $balance -= $request->cash_outflow; // Deduct cash outflow from balance
            // return response($lastCashFlow);
            $this->deductCategoryBudget($allocatedBudgetEntry, $request->category, $request->cash_outflow, $lastCashFlow);
        }

        // Handle cash inflow
        if ($request->cash_inflow > 0) {
            $balance += $request->cash_inflow; // Add cash inflow to balance
            $this->addCategoryBudget($allocatedBudgetEntry, $request->category, $request->cash_inflow, $lastCashFlow);
        }

        // Generate a unique reference code (e.g., DPM followed by current timestamp)
        $referenceCode = 'DPM' . time();

        // Save the new cash flow entry
        CashFlow::create([
            'date' => $request->date,
            'description' => $request->description,
            'category' => $request->category,
            'cash_inflow' => $request->cash_inflow ?? 0.0, // Ensure cash inflow is recorded
            'cash_outflow' => $request->cash_outflow ?? 0.0, // Ensure cash outflow is recorded
            'committed_budget' => $lastCashFlow ? $lastCashFlow->committed_budget : 0,
            'balance' => $balance,
            'reference_code' => $referenceCode, // Reference code generated dynamically
            'budget_project_id' => $request->budget_project_id,
        ]);

        return redirect()->back()->with('success', 'DPM recorded and cash flow updated.');
    }

    private function getCategoryBudget(TotalBudgetAllocated $allocatedBudgetEntry, $category)
    {
        switch ($category) {
            case 'Salary':
                return $allocatedBudgetEntry->total_salary;
            case 'Facility':
                return $allocatedBudgetEntry->total_facility_cost;
            case 'Material':
                return $allocatedBudgetEntry->total_material_cost;
            case 'Overhead':
                return $allocatedBudgetEntry->total_cost_overhead;
            case 'Financial':
                return $allocatedBudgetEntry->total_financial_cost;
            case 'Capital Expenditure':
                return $allocatedBudgetEntry->total_capital_expenditure;
            default:
                return 0; // Or throw an error for an invalid category
        }
    }

    // Helper method to add cash inflow to the corresponding category budget
    private function addCategoryBudget(TotalBudgetAllocated $allocatedBudgetEntry, $category, $cashInflow, $lastCashFlow)
    {
        switch ($category) {
            case 'Salary':
                $allocatedBudgetEntry->total_salary += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance
                break;
            case 'Facility':
                $allocatedBudgetEntry->total_facility_cost += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance

                break;
            case 'Material':
                $allocatedBudgetEntry->total_material_cost += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance

                break;
            case 'Overhead':
                $allocatedBudgetEntry->total_cost_overhead += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance

                break;
            case 'Financial':
                $allocatedBudgetEntry->total_financial_cost += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance

                break;
            case 'Capital Expenditure':
                $allocatedBudgetEntry->total_capital_expenditure += $cashInflow;
                $allocatedBudgetEntry->allocated_budget += $cashInflow;
                $lastCashFlow->balance += $cashInflow; // Update last cash flow balance

                break;
        }

        // Save the updated allocated budget entry
        $allocatedBudgetEntry->save();
        //save the cash flow
        $lastCashFlow->save();
    }

    // Helper method to add cash Outflow to the corresponding category budget

    private function deductCategoryBudget(TotalBudgetAllocated $allocatedBudgetEntry, $category, $cashOutflow, $lastCashFlow)
    {
        switch ($category) {
            case 'Salary':
                $allocatedBudgetEntry->total_salary -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;

                break;
            case 'Facility':
                $allocatedBudgetEntry->total_facility_cost -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;

                break;
            case 'Material':
                $allocatedBudgetEntry->total_material_cost -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;

                break;
            case 'Overhead':
                $allocatedBudgetEntry->total_cost_overhead -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;

                break;
            case 'Financial':
                $allocatedBudgetEntry->total_financial_cost -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;

                break;
            case 'Capital Expenditure':
                $allocatedBudgetEntry->total_capital_expenditure -= $cashOutflow;
                $allocatedBudgetEntry->total_dpm += $cashOutflow;
                $lastCashFlow->balance -= $cashOutflow;
                break;
        }

        // Save the updated allocated budget entry
        $allocatedBudgetEntry->save();
        //save the entry for cash flow
        $lastCashFlow->save();
    }
}
