<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    return $this->hasMany(CostOverhead::class);
  }

  public function financialCosts()
  {
    return $this->hasMany(FinancialCost::class);
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
