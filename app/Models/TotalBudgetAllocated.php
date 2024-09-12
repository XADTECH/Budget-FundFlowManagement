<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TotalBudgetAllocated extends Model
{
    use HasFactory;

    protected $table = 'total_budget_allocated'; // Explicitly specify the table name

    protected $fillable = ['budget_project_id','total_budget_allocated', 'expense_head']; // Explicitly specify the table name    

    // Define the relationship with BudgetProject
    public function budgetProject()
    {
        return $this->hasMany(BudgetProject::class, 'budget_project_id');
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
