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
    'bal_under_over_budget',
    'total_budget_allocated',
    'total_dpm_expense',
    'total_lpo_expense',
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

      // Method to allocate budget
    public function allocateBudget($amount)
    {
        $this->total_budget_allocated += $amount;
        $this->save();

        // Record cash inflow
        CashFlow::create([
            'budget_project_id' => $this->id,
            'type' => 'inflow',
            'amount' => $amount,
            'description' => 'Budget allocation',
        ]);
    }
    
        public function processPurchaseOrder(PurchaseOrder $purchaseOrder)
        {
            if ($this->canCoverExpense($purchaseOrder->total_amount)) {
                $this->deductExpense($purchaseOrder->total_amount, 'Purchase Order');
                $purchaseOrder->status = 'Approved';
                $purchaseOrder->save();
                return true;
            }
            $purchaseOrder->status = 'Rejected';
            $purchaseOrder->save();
            return false;
        }
    
        public function logDailyPaymentExpense($amount)
        {
            if ($this->canCoverExpense($amount)) {
                $this->deductExpense($amount, 'Daily Payment Expense');
                return true;
            }
            return false;
        }
    
        protected function deductExpense($amount, $description)
        {
            if ($this->current_balance >= $amount) {
                $this->current_balance -= $amount;
                $this->save();
    
                // Record cash outflow
                CashFlow::create([
                    'budget_project_id' => $this->id,
                    'type' => 'outflow',
                    'amount' => $amount,
                    'description' => $description,
                ]);
    
                return true;
            }
            return false;
        }
    
        public function canCoverExpense($amount)
        {
            return $this->current_balance >= $amount;
        }
    
}
