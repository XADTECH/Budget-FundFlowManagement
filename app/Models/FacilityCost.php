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
        'type', // Type of record (Cost)
        'project', // Project name
        'po', // Type of expense (OPEX)
        'expenses', // Specific expense (Salary)
        'description', // Description of the role or details (Project Manager)
        'status', // Status of the budget entry (New Hiring)
        'cost_per_month', // Salary cost per staff member per month (5,000)
        'no_of_staff', // Number of staff members (5)
        'no_of_months', // Duration of the project in months (5)
        'total_cost', // Total calculated cost (5,000 * 5 * 5 = 125,000)
        'average_cost', // Average cost per staff per month (5,000)
        'approval_status', // Approval status
        'percentage_cost'
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
    // Calculate total cost based on no_of_staff and no_of_months
    if ($this->cost_per_month > 0) {
        if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
            // Both staff and months are greater than zero
            $this->total_cost = $this->cost_per_month * $this->no_of_staff * $this->no_of_months;
        } elseif ($this->no_of_staff == 0 && $this->no_of_months == 0) {
            // Both are zero, set total cost to cost_per_month
            $this->total_cost = $this->cost_per_month;
        } elseif ($this->no_of_staff == 0) {
            // No staff, calculate total cost based on months
            $this->total_cost = $this->cost_per_month * $this->no_of_months;
        } elseif ($this->no_of_months == 0) {
            // No months, calculate total cost based on staff
            $this->total_cost = $this->cost_per_month * $this->no_of_staff;
        }
    } else {
        $this->total_cost = 0; // If cost_per_month is zero or invalid
    }

    // Calculate percentage based on total cost if it's greater than zero
    if ($this->total_cost > 0) {
        $this->percentage_cost = $this->cost_per_month / $this->total_cost; // Store as a decimal
    } else {
        $this->percentage_cost = 0; // Set to 0 if total cost is 0
    }

    // Save the updated total cost and percentage cost to the database
    $this->save();
    
    return $this->total_cost;
}


    // Calculate average cost dynamically
   // Calculate average cost dynamically
public function calculateAverageCost()
{
    // Initialize average_cost to 0
    $this->average_cost = 0;

    if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
        // Both staff and months are greater than zero
        $this->average_cost = $this->total_cost / ($this->no_of_staff * $this->no_of_months);
    } elseif ($this->no_of_staff > 0 && $this->no_of_months == 0) {
        // Only no_of_staff is greater than zero
        $this->average_cost = $this->total_cost / $this->no_of_staff;
    } elseif ($this->no_of_staff == 0 && $this->no_of_months > 0) {
        // Only no_of_months is greater than zero
        $this->average_cost = $this->total_cost / $this->no_of_months;
    } elseif ($this->no_of_staff == 0 && $this->no_of_months == 0) {
        // Both are zero; handle accordingly (e.g., set average_cost to total_cost)
        $this->average_cost = $this->total_cost; // Or another appropriate default value
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
