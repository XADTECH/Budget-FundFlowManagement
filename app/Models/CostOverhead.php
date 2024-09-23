<?php
namespace App\Models;

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
