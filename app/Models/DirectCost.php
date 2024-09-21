<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Salary;
use App\Models\FacilitiesCost;
use App\Models\MaterialCost;

class DirectCost extends Model
{
  use HasFactory;

  protected $table = 'direct_cost';
  protected $fillable = ['budget_project_id', 'total_cost'];

  public function budgetProject()
  {
    return $this->belongsTo(BudgetProject::class);
  }

  public function salaries()
  {
    return $this->hasMany(Salary::class);
  }

  public function facilitiesCosts()
  {
    return $this->hasMany(FacilityCost::class);
  }

  public function materialCosts()
  {
    return $this->hasMany(MaterialCost::class);
  }

  public function revenuePlans()
  {
      return $this->hasMany(RevenuePlan::class, 'budget_project_id');
  }

  public function pettyCash()
  {
      return $this->hasMany(PettyCash::class, 'project_id');
  }

  public function nocPayment()
  {
      return $this->hasMany(NocPayment::class, 'project_id');
  }

  public function calculateTotalDirectCost()
    {
        // Calculate totals from related models
        $salariesTotal = $this->salaries()->sum('total_cost');
        $facilitiesTotal = $this->facilitiesCosts()->sum('total_cost');
        $materialTotal = $this->materialCosts()->sum('total_cost');
        $pettyCashTotal = $this->pettyCash()->sum('amount');
        $nocPaymentTotal = $this->nocPayment()->sum('amount');

        // Return the sum of all totals
        return $salariesTotal + $facilitiesTotal + $materialTotal + $pettyCashTotal + $nocPaymentTotal;
    }
}
