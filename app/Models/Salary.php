<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salaries'; // Explicitly specify the table name

    protected $fillable = [
        'direct_cost_id',        // Foreign key reference to DirectCost
        'budget_project_id',     // Foreign key reference to BudgetProject
        'type',                  // Type of record (Cost)
        'project',               // Project name
        'po',                    // Type of expense (OPEX)
        'expenses',              // Specific expense (Salary)
        'other_expense',
        'description',           // Description of the role or details (Project Manager)
        'status',                // Status of the budget entry (New Hiring)
        'cost_per_month',        // Salary cost per staff member per month (e.g., 5,000)
        'no_of_staff',           // Number of staff members (e.g., 5)
        'no_of_months',          // Duration of the project in months (e.g., 5)
        'total_cost',            // Total calculated cost (e.g., 5,000 * 5 * 5 = 125,000)
        'average_cost',          // Average cost per staff per month (e.g., 5,000)
        'approval_status',       // Approval status
        'percentage_cost',
        'visa_status'
    ];

    // Relationship to DirectCost
    public function directCost()
    {
        return $this->belongsTo(DirectCost::class, 'direct_cost_id');
    }

    // Relationship to BudgetProject
    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
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
            // Calculate total cost for the given months and staff
            $this->total_cost = $this->cost_per_month * $this->no_of_staff * $this->no_of_months;
        } else {
            // If cost_per_month is zero or invalid, set total cost to 0
            $this->total_cost = 0;
        }

        // If overseeing_sites is greater than 0, calculate cost per site and percentage cost per site
        if ($this->overseeing_sites > 0) {
            $cost_per_site = $this->total_cost / $this->overseeing_sites;

            // Calculate percentage cost per site as a decimal (e.g., 0.20 for 20%)
            $this->percentage_cost = $cost_per_site / $this->total_cost; // This will store 0.20 instead of 20%
        } else {
            // If there are no overseeing sites, calculate the percentage cost based on salary, months, and staff
            // Here, you calculate a general worker percentage cost, which could be based on their share of the overall budget

            // Example: Assume that each worker contributes equally based on total number of workers and months worked
            // We can take 1 worker's contribution (cost_per_month * no_of_months) and divide it by the total_cost
            $individual_worker_cost = $this->cost_per_month * $this->no_of_months;

            if ($this->total_cost > 0) {
                $this->percentage_cost = $individual_worker_cost / $this->total_cost; // Calculate percentage based on overall cost
            } else {
                $this->percentage_cost = 0; // If total cost is 0, set percentage cost to 0
            }
        }
        // Save the updated total cost and percentage cost to the database
        $this->save();

        return $this->total_cost;
    }


    // Calculate average cost dynamically
    public function calculateAverageCost()
    {
        if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
            // Use total_cost for average cost calculation
            $this->average_cost = $this->total_cost / ($this->no_of_staff * $this->no_of_months);
        } else {
            // Default value if no_of_staff or no_of_months is zero
            $this->average_cost = $this->total_cost;
        }

        $this->save();
        return $this->average_cost;
    }

    public function updateBudget($expenseHead)
    {
        // Fetch or create the total budget allocated for the project
        $totalBudgetAllocated = new TotalBudgetAllocated();

        // Sum the total cost of approved salaries for the given budget_project_id
        $approved_total_cost = Salary::where('budget_project_id', $this->budget_project_id)
            ->where('approval_status', 'approved') // Only approved salaries
            ->sum('total_cost');

        // Update the total_budget_allocated field in the TotalBudgetAllocated table
        $totalBudgetAllocated->total_budget_allocated = $approved_total_cost;
        $totalBudgetAllocated->budget_project_id = $this->budget_project_id;
        $totalBudgetAllocated->expense_head = $expenseHead;

        // Save the updated data
        $totalBudgetAllocated->save();
    }


    // Approve the salary entry
    public function approve()
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
        $total_cost = Salary::where('budget_project_id', $budgetProjectId)
            ->where('approval_status', 'approved') // Only approved salaries
            ->sum('total_cost');

        return $total_cost;
    }
}
