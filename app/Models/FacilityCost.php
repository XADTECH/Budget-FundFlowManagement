<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityCost extends Model
{
    use HasFactory;

    protected $table = 'facility_cost';

    protected $fillable = [
        'direct_cost', // Foreign key reference to DirectCost
        'budget_project',
        'sn', // Serial number or identifier
        'type', // Type of record (Cost)
        'project', // Project name
        'po', // Type of expense (OPEX)
        'contract',
        'expenses', // Specific expense (Salary)
        'description', // Description of the role or details (Project Manager)
        'status', // Status of the budget entry (New Hiring)
        'cost_per_month', // Salary cost per staff member per month (5,000)
        'no_of_staff', // Number of staff members (5)
        'no_of_months', // Duration of the project in months (5)
        'total_cost', // Total calculated cost (5,000 * 5 * 5 = 125,000)
        'average_cost', // Average cost per staff per month (5,000)
        'approval_status', // Approval status
    ];

    public function directCost()
    {
        return $this->belongsTo(DirectCost::class);
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }

       // Define the relationship with TotalBudgetAllocated based on the project
       public function totalBudgetAllocated()
       {
           return $this->hasOne(TotalBudgetAllocated::class, 'budget_project_id');
       }

    // Calculate total cost dynamically
    public function calculateTotalCost()
    {
        // Ensure cost_per_month is a positive value
        if ($this->cost_per_month > 0) {
            // Case 1: Both staff and months are greater than 0
            if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
                $this->total_cost = $this->cost_per_month * $this->no_of_staff * $this->no_of_months;
            }
            // Case 2: Staff > 0 but no months provided (default to 1 month)
            elseif ($this->no_of_staff > 0 && $this->no_of_months == 0) {
                $this->total_cost = $this->cost_per_month * $this->no_of_staff;
            }
            // Case 3: No staff but months provided (default to 1 staff member)
            elseif ($this->no_of_staff == 0 && $this->no_of_months > 0) {
                $this->total_cost = $this->cost_per_month * $this->no_of_months;
            }
            // Case 4: Both staff and months are zero, total cost should be zero
            else {
                $this->total_cost = $this->cost_per_month;
            }
        } else {
            // Case where cost_per_month is zero or invalid, set total cost to 0
            $this->total_cost = 0;
        }

        // Save the updated total cost to the database
        $this->save();
        return $this->total_cost;
    }

   // Update total budget and allocation
   public function updateBudget($expenseHead)
   {
       // Fetch or create the total budget allocated for the project
       $totalBudgetAllocated = new TotalBudgetAllocated();

       // Sum the total cost of approved salaries for the given budget_project_id
       $approved_total_cost = FacilityCost::where('budget_project_id', $this->budget_project_id)
                                    ->where('approval_status', 'approved') // Only approved salaries
                                    ->sum('total_cost');

       // Update the total_budget_allocated field in the TotalBudgetAllocated table
       $totalBudgetAllocated->total_budget_allocated = $approved_total_cost;
       $totalBudgetAllocated->budget_project_id = $this->budget_project_id;
       $totalBudgetAllocated->expense_head = $expenseHead;

       // Save the updated data
       $totalBudgetAllocated->save();
   }

    // Calculate average cost dynamically
    public function calculateAverageCost()
    {
        if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
            // Use no_of_staff and no_of_months for calculation
            $this->average_cost = $this->total_cost / ($this->no_of_staff * $this->no_of_months);
        } elseif ($this->no_of_months > 0) {
            // Fallback to dividing total_cost by no_of_months if no_of_staff is null or 0
            $this->average_cost = $this->total_cost / $this->no_of_months;
        } else {
            // Default value if no_of_months is also null or 0
            $this->average_cost = $this->total_cost; // Or another default value
        }

        $this->save();
        return $this->average_cost;
    }

    // Approve the salary entry
    public function approve($userId)
    {
        $this->approval_status = 'Approved';
        $this->save();
    }

    // Reject the salary entry
    public function reject()
    {
        $this->approval_status = 'Rejected';
        $this->save();
    }

     // Reject the salary entry
     public function Pending()
     {
         $this->approval_status = 'Pending';
         $this->save();
     }

     public static function sumTotalCost($budgetProjectId)
     {
        $total_cost = FacilityCost::where('budget_project_id', $budgetProjectId)
        ->where('approval_status', 'approved') // Only approved salaries
        ->sum('total_cost');

        return $total_cost;
     }
     
}
