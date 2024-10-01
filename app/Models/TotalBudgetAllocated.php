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
        'budget_project_id',
        'total_salary',
        'total_facility_cost',
        'total_material_cost',
        'total_cost_overhead',
        'total_financial_cost',
        'total_capital_expenditure',
        'allocated_budget',
        'reference_code',
    ];


    // Define any relationships if needed
    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
    }

    // Define the relationship with Salary
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'budget_project_id');
    }

    // Define the relationship with FacilityCost
    public function facilityCosts()
    {
        return $this->hasMany(FacilityCost::class, 'budget_project_id');
    }

    // Define the relationship with MaterialCost
    public function materialCosts()
    {
        return $this->hasMany(MaterialCost::class, 'budget_project_id');
    }

    // Define the relationship with CostOverhead
    public function costOverheads()
    {
        return $this->hasMany(CostOverhead::class, 'budget_project_id');
    }

    // Define the relationship with FinancialCost
    public function financialCosts()
    {
        return $this->hasMany(FinancialCost::class, 'budget_project_id');
    }

    
}
