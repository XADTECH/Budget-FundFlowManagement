<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TotalBudgetAllocated extends Model
{
    use HasFactory;
    // Define the table associated with the model
    protected $table = 'total_budget_allocated';

    // Specify which attributes should be mass assignable
    protected $fillable = ['budget_project_id', 'approved_budget', 'total_budget_allocated', 'total_budget_utilized', 'duration', 'expense_head', 'reference_code'];

    // Specify the attributes that should be cast to native types
    protected $casts = [
        'approved_budget' => 'decimal:2',
        'total_budget_allocated' => 'decimal:2',
        'total_budget_utilized' => 'decimal:2',
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
