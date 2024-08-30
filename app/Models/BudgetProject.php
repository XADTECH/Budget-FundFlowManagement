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
    return $this->hasMany(DirectCost::class);
  }

  public function indirectCosts()
  {
    return $this->hasMany(IndirectCost::class);
  }
}
