<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetProject extends Model
{
    use HasFactory;

    protected $table = 'budget_project';

    protected $fillable = ['reference_code', 'start_date', 'end_date', 'project_name', 'business_unit', 'manager_id', 'client', 'region', 'country', 'description', 'budget_type', 'site_name', 'month', 'approval_status', 'bal_under_over_budget', 'total_budget_allocated', 'total_dpm_expense', 'total_lpo_expense', 'status', 'approve_by'];

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

    // Define the one-to-one or one-to-many relationship with TotalBudgetAllocated
    public function totalBudgetAllocated()
    {
        return $this->hasOne(TotalBudgetAllocated::class, 'budget_project_id');
    }

    // Method to calculate utilization (total expenses)
    public function getUtilization()
    {
        // Access the related TotalBudgetAllocated record
        $budgetAllocated = $this->totalBudgetAllocated;

        // Check if there's related budget allocation data
        if ($budgetAllocated) {
            return $budgetAllocated->total_dpm + $budgetAllocated->total_lpo;
        }

        // Return 0 if there's no related budget allocation
        return 0;
    }
    // Method to calculate Remaining Budget
    public function getRemainingBudget()
    {
        $budgetAllocated = $this->totalBudgetAllocated;

        // Check if there's related budget allocation data
        if ($budgetAllocated) {
            // Remaining budget is total budget allocated minus total expenses
            return $budgetAllocated->allocated_budget - $this->getUtilization();
        }

        // Return null or 0 if there's no related budget allocation
        return null;
    }
    public function getUtilizationPercentage()
    {
        // Access the related TotalBudgetAllocated record
        $budgetAllocated = $this->totalBudgetAllocated;

        // Check if there's related budget allocation data
        if ($budgetAllocated && $budgetAllocated->budget_allocated != 0) {
            // Calculate total expenses from TotalBudgetAllocated
            $totalExpenses = $budgetAllocated->total_dpm + $budgetAllocated->total_lpo;

            // Return the utilization percentage
            return ($totalExpenses / $budgetAllocated->total_budget_allocated) * 100;
        }

        // Return 0 if no budget is allocated or no related record
        return 0;
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

    // Hook into the deleting event to delete related records
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($budgetProject) {
            // Delete related models
            $budgetProject->directCosts()->delete();
            $budgetProject->indirectCosts()->delete();
            $budgetProject->salaries()->delete();
            $budgetProject->facilityCosts()->delete();
            $budgetProject->materialCosts()->delete();
            $budgetProject->costOverheads()->delete();
            $budgetProject->financialCosts()->delete();
            $budgetProject->revenuePlans()->delete();
            $budgetProject->capitalExpenditures()->delete();
            $budgetProject->totalBudgetAllocated()->delete();
        });
    }
}
