<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TotalBudgetAllocated extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'allocated_budget';

    protected $fillable = [
        'budget_project_id', // Foreign key for the budget project
        'total_salary', // Total salary cost
        'committed_allocated_salary', // Committed salary cost
        'total_facility_cost', // Total facility cost
        'committed_allocated_facility_cost', // Committed facility cost
        'total_material_cost', // Total material cost
        'committed_allocated_material_cost', // Committed material cost
        'total_cost_overhead', // Total cost overhead
        'committed_allocated_cost_overhead', // Committed cost overhead
        'total_financial_cost', // Total financial cost
        'committed_allocated_financial_cost', // Committed financial cost
        'total_capital_expenditure', // Total capital expenditure
        'committed_allocated_capital_expenditure', // Commit\ted capital expenditure
        'allocated_budget', // Total allocated budget
        'initial_allocation_budget', // Initial allocation for the budget
        'committed_allocated_budget',
        'committed_remaining_fund', // Committed remaining funds
        'reference_code', // Reference code for the budget
        'remaining_fund', // Remaining funds
        'total_dpm', // Total daily payment
        'total_lpo', // Total Local Purchase Order (LPO)
        'committed_total_lpo', // Committed total LPO
    ];

    // Define relationships
    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'budget_project_id');
    }

    public function facilityCosts()
    {
        return $this->hasMany(FacilityCost::class, 'budget_project_id');
    }

    public function materialCosts()
    {
        return $this->hasMany(MaterialCost::class, 'budget_project_id');
    }

    public function costOverheads()
    {
        return $this->hasMany(CostOverhead::class, 'budget_project_id');
    }

    public function financialCosts()
    {
        return $this->hasMany(FinancialCost::class, 'budget_project_id');
    }
}
