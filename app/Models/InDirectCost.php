<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CostOverhead;
use App\Models\FinancialCost;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndirectCost extends Model
{
  use HasFactory;

  protected $table = 'indirect_cost';

  protected $fillable = [
    'budget_project_id', // Foreign key reference
    'total_cost',
  ];

  public function budgetProject()
  {
    return $this->belongsTo(BudgetProject::class);
  }

  public function costOverheads()
  {
    return $this->hasMany(CostOverhead::class, 'in_direct_cost_id'); // Specify foreign key here
  }

  public function financialCosts()
  {
    return $this->hasMany(FinancialCost::class, 'in_direct_cost_id');
  }

  public function revenuePlans()
  {
      return $this->hasMany(RevenuePlan::class, 'budget_project_id');
  }

  public function calculateTotalIndirectCost()
  {
    // Calculate totals from related models
    $costOverheadsTotal = $this->costOverheads()->sum('total_cost');
    $financialCostsTotal = $this->financialCosts()->sum('total_cost');

    // Return the sum of all totals
    return $costOverheadsTotal + $financialCostsTotal;
  }
}
