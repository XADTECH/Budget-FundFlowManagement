<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetProject extends Model
{
  use HasFactory;

  protected $table = 'budget_project';

  protected $fillable = [
    'reference_code',
    'start_date',
    'end_date',
    'project_name',
    'business_unit',
    'manager_id',
    'client',
    'region',
    'country',
    'description',
    'budget_type',
    'site_name',
    'month',
    'approval_status',
    'daily_payment_expense',
    'lpo_amount',
    'bal_under_over_budget',
    'total_budget_allocated',
    'total_dpm_expense',
    'total_lpo_expense',
    'total_budget',
    'status',
  ];

  public function directCosts()
  {
    return $this->hasMany(DirectCost::class, 'budget_project_id');
  }

  public function indirectCosts()
  {
    return $this->hasMany(IndirectCost::class, 'budget_project_id');
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

  public function revenuePlans()
  {
      return $this->hasMany(RevenuePlan::class, 'budget_project_id');
  }

  public function capitalExpenditures()
  {
      return $this->hasMany(CapitalExpenditure::class, 'budget_project_id');
  }

      public function getUtilization()
    {
      return $this->total_dpm_expense + $this->total_lpo_expense;
    }

        public function getUtilizationPercentage()
    {
        if ($this->total_budget_allocated == 0) {
            return 0; // To avoid division by zero
        }

        $totalExpenses = $this->total_dpm_expense + $this->total_lpo_expense;
        return ($totalExpenses / $this->total_budget_allocated) * 100;
    }

        // Method to calculate Remaining Budget
        public function getRemainingBudget()
        {
            // Remaining budget is total budget allocated minus total expenses
            return $this->total_budget_allocated - $this->getUtilization();
        }
    
}
