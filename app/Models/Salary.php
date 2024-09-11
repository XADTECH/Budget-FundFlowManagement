<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salaries';

    protected $fillable = [
        'direct_cost_id', // Foreign key reference to DirectCost
        'budget_project_id', // Foreign key reference to BudgetProject
        'sn', // Serial number or identifier
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
        'total_budget', // Total budget allocated
        'total_budget_allocated', // Total of each entry
        'approval_status', // Approval status
        'approved_by', // ID of the user who approved
    ];

    public function directCost()
    {
        return $this->belongsTo(DirectCost::class);
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }

    // Calculate total cost dynamically
    public function calculateTotalCost()
    {
        $this->total_cost = $this->cost_per_month * $this->no_of_staff * $this->no_of_months;
        $this->save();
        return $this->total_cost;
    }

    // Calculate average cost dynamically
    public function calculateAverageCost()
    {
        if ($this->no_of_staff * $this->no_of_months == 0) {
            $this->average_cost = 0;
        } else {
            $this->average_cost = $this->total_cost / ($this->no_of_staff * $this->no_of_months);
        }
        $this->save();
        return $this->average_cost;
    }

 // Update total budget and allocation
public function updateBudget()
{
    // Fetch the current total budget and total allocated budget from the database
    $current_total_budget = Salary::where('budget_project_id', $this->budget_project_id)
                                  ->sum('total_budget');

    $current_total_budget_allocated = Salary::where('budget_project_id', $this->budget_project_id)
                                            ->sum('total_budget_allocated');

    // Update total budget by adding new total cost to the existing budget
    $this->total_budget = $current_total_budget + $this->total_cost;

    // Update total budget allocated similarly
    $this->total_budget_allocated = $current_total_budget_allocated + $this->total_cost;

    // Save the updated budget and allocation
    $this->save();
}

    // Approve the salary entry
    public function approve($userId)
    {
        $this->approval_status = 'Approved';
        $this->approved_by = $userId;
        $this->save();
    }

    // Reject the salary entry
    public function reject()
    {
        $this->approval_status = 'Rejected';
        $this->approved_by = null;
        $this->save();
    }
}
