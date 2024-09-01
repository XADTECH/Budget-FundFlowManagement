<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCost extends Model
{
  use HasFactory;

  protected $table = 'financial_cost';

  protected $fillable = [
    'in_direct_cost_id', // Foreign key reference to DirectCost
    'budget_project',
    'sn', // Serial number or identifier
    'type', // Type of record (Cost)
    'project', // Project name
    'po', // Type of expense (OPEX)
    'expenses', // Specific expense (Salary)
    'description', // Description of the role or details (Project Manager)
    'status', // Status of the budget entry (New Hiring)
    'cost_per_month', // Salary cost per staff member per month (5,000)
    'no_of_staff', // Number of staff members (5)
    'no_of_months', // Duration of the project in months (5)
    'total_cost', // Total calculated cost (5,000 * 5 * 5 = 125,000)
    'average_cost', // Average cost per staff per month (5,000)
  ];

  public function IndirectCost()
  {
    return $this->belongsTo(IndirectCost::class);
  }

  public function budgetProject()
  {
    return $this->belongsTo(BudgetProject::class);
  }

  // Calculate total cost dynamically
  public function calculateTotalCost()
  {
    $this->total_cost = $this->cost_per_month * $this->no_of_staff * $this->no_of_months;
    $this->save();
    return $this->total_cost;
  }

  // Calculate average cost dynamically
  public function calculateAverageCost()
  {
    $this->average_cost = $this->total_cost / ($this->no_of_staff * $this->no_of_months);
    $this->save();
    return $this->average_cost;
  }
}
