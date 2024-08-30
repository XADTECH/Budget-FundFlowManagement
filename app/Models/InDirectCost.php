<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndirectCost extends Model
{
  use HasFactory;

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
}
