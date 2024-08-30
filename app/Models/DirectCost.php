<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DirectCost extends Model
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

  public function salaries()
  {
    return $this->hasMany(Salary::class);
  }

  public function facilitiesCosts()
  {
    return $this->hasMany(FacilitiesCost::class);
  }

  public function materialCosts()
  {
    return $this->hasMany(MaterialCost::class);
  }
}
