<?php
namespace App\Models;
use App\Models\Salary;
use App\Models\CapitalExpenditure;

use Illuminate\Database\Eloquent\Model;

class CostOverhead extends Model
{
    protected $table = 'cost_overhead'; // Ensure the model points to the correct table

    protected $fillable = [
        'in_direct_cost_id', // Foreign key reference to DirectCost
        'budget_project_id', // Foreign key reference to BudgetProject
        'type', // Type of record (Cost)
        'project', // Project name
        'po', // Type of expense (OPEX)
        'expenses', // Specific expense (Salary)
        'amount', // Total amount (decimal)
    ];

    // Define relationships
    public function indirectCost()
    {
        return $this->belongsTo(IndirectCost::class, 'in_direct_cost_id');
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
    }

    //calculate based on expense
    public function calculateBasedOnExpenseHead()
    {
        // Get the selected expense head
        $expenseHead = $this->expenses;
        $result = 0;

        // Perform specific calculations based on the expense head
        switch ($expenseHead) {
            case 'HO Cost':
                $sumAmount = Salary::where('visa_status', 'Xad Visa')->sum('percentage_cost');
                return $this->amount * $sumAmount;
                break;

            case 'Annual Benefit':
                // Calculation for Annual Benefit
                $sumAmount = Salary::sum('total_cost');
                return ($this->amount / 100) * $sumAmount;
                break;

            case 'Insurance Cost':
                // Calculation for Insurance Cost
                $sumAmount = Salary::where('visa_status', 'Xad Visa')->sum('percentage_cost');
                return $this->amount * $sumAmount;
                break;

            case 'Visa Renewal':
                // Calculation for Visa Renewal
                $sumAmount = Salary::where('visa_status', 'Xad Visa')->sum('percentage_cost');
                return $this->amount * $sumAmount;
                break;

            case 'Other':
                // Calculation for Other expenses
                return $result = $this->amount;
                break;

            default:
                // Default calculation if no specific head is selected
                $result = $this->amount;
                break;
        }

        return $result; // Return the calculated value
    }

     // Calculate depreciation tools based on project ID
     public function depreciationTools($project_id)
     {
         // Sum the total cost for the given project
         return CapitalExpenditure::where('budget_project_id', $project_id)->sum('total_cost') / 24;
     }
 
     // Calculate total overhead
     public static function calculateTotalOverhead($project_id)
     {
         // Sum of overhead costs for the given project
         $totalCostOverhead = self::where('budget_project_id', $project_id)->sum('amount');
 
         // Create an instance of CostOverhead
         $costOverheadInstance = new self();
         
         // Calculate depreciation
         $depreciation = $costOverheadInstance->depreciationTools($project_id); // Ensure project_id is passed here
 
         // Total overhead
         return $totalCostOverhead + $depreciation;
     }

    // Define the relationship with TotalBudgetAllocated based on the project
    public function totalBudgetAllocated()
    {
        return $this->hasOne(TotalBudgetAllocated::class, 'budget_project_id');
    }

    // Approve the material entry
    public function approve()
    {
        $this->approval_status = 'Approved';
        $this->save();
    }

    // Reject the material entry
    public function reject()
    {
        $this->approval_status = 'Rejected';
        $this->save();
    }

    // Mark the material entry as pending
    public function pending()
    {
        $this->approval_status = 'Pending';
        $this->save();
    }

    public static function sumTotalCost($budgetProjectId)
    {
        $total_cost = CostOverhead::where('budget_project_id', $budgetProjectId)
            ->where('approval_status', 'approved') // Only approved salaries
            ->sum('total_cost');

        return $total_cost;
    }
}
