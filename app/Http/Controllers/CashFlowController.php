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

        //return response($request->all());
          // Validate request data
          $request->validate([
              'date' => 'required|date',
              'description' => 'required|string',
              'category' => 'required|string',
              'cash_outflow' => 'required|numeric',
              'budget_project_id' => 'required|integer',
          ]);
      
          // Fetch the last recorded cash flow for this project and category
          $lastCashFlow = CashFlow::where('budget_project_id', $request->budget_project_id)
                                  ->where('category', $request->category)
                                  ->orderBy('date', 'desc')
                                  ->first();

        
      
          // Calculate the balance
          $balance = $lastCashFlow ? $lastCashFlow->balance - $request->cash_outflow : 0;
      
          // Get the allocated budget for the project and category
          $allocatedBudgetEntry = TotalBudgetAllocated::where('budget_project_id', $request->budget_project_id)
                                                      ->first();
      
          if (!$allocatedBudgetEntry) {
              return redirect()->back()->withErrors(['budget_not_found' => 'No allocated budget found for this project.'])->withInput();
          }
      
          // Assuming there is a method to get the total allocated budget for the specific category
          $allocatedBudget = $this->getCategoryBudget($allocatedBudgetEntry, $request->category);

          //return response($request->cash_outflow);
          
          // Check if there's enough budget for the transaction
          if ($request->cash_outflow > $allocatedBudget) {
              return redirect()->back()->withErrors(['insufficient_budget' => 'Insufficient budget for this transaction.'])->withInput();
          }
      
          // Generate a unique reference code (e.g., DPM followed by current timestamp)
          $referenceCode = 'DPM' . time();
      
          // Save the new cash flow entry
          CashFlow::create([
              'date' => $request->date,
              'description' => $request->description,
              'category' => $request->category,
              'cash_inflow' => 0.00,  // No inflow for DPM
              'cash_outflow' => $request->cash_outflow,
              'committed_budget' => $lastCashFlow ? $lastCashFlow->committed_budget : 0,
              'balance' => $balance,
              'reference_code' => $referenceCode,  // Reference code generated dynamically
              'budget_project_id' => $request->budget_project_id,
          ]);
      
          // Deduct the cash outflow from the corresponding category budget
          $this->deductCategoryBudget($allocatedBudgetEntry, $request->category, $request->cash_outflow, $lastCashFlow);
      
          return redirect()->back()->with('success', 'DPM recorded and cash flow updated.');
        }
      
      // Helper method to get the total allocated budget for the specific category
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
      
      // Helper method to deduct cash outflow from the corresponding category budget
      private function deductCategoryBudget(TotalBudgetAllocated $allocatedBudgetEntry, $category, $cashOutflow, $lastCashFlow)
      {
          switch ($category) {
              case 'Salary':
                  $allocatedBudgetEntry->total_salary -= $cashOutflow;
                  $lastCashFlow->balance -= $cashOutflow;
                  break;
              case 'Facility':
                  $allocatedBudgetEntry->total_facility_cost -= $cashOutflow;
                  $lastCashFlow->balance -= $cashOutflow;
                  break;
              case 'Material':
                  $allocatedBudgetEntry->total_material_cost -= $cashOutflow;
                  $lastCashFlow->balance -= $cashOutflow;
                  break;
              case 'Overhead':
                  $allocatedBudgetEntry->total_cost_overhead -= $cashOutflow;
                  $lastCashFlow->balance -= $cashOutflow;
                  break;
              case 'Financial':
                  $allocatedBudgetEntry->total_financial_cost -= $cashOutflow;
                  $lastCashFlow->balance -= $cashOutflow;
                  break;
              case 'Capital Expenditure':
                  $allocatedBudgetEntry->total_capital_expenditure -= $cashOutflow;
                  $lastCashFlow->balance -= $cashOutflow;
                  break;
          }
      
          // Save the updated allocated budget entry
          $allocatedBudgetEntry->save();
      }
 
    
}
