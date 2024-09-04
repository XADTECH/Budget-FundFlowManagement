<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitalExpenditure extends Model
{
    use HasFactory;

    protected $table = 'capital_expenditure';

    protected $fillable = [
        'direct_cost', // Foreign key reference to DirectCost
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

    public function budgetProject()
    {
      return $this->belongsTo(BudgetProject::class);
    }

     // Calculate total cost dynamically
     public function calculateTotalCost()
     {
         if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
             $this->total_cost = $this->cost_per_month * $this->no_of_staff * $this->no_of_months;
         } else {
             $this->total_cost = $this->total_cost = $this->cost_per_month * $this->no_of_months;; 
         }
         $this->save();
         return $this->total_cost;
     }

  // Calculate average cost dynamically
  public function calculateAverageCost()
  {
      if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
        $this->average_cost = $this->cost_per_month / $this->no_of_months;; 
      } else {
        $this->average_cost = $this->cost_per_month / $this->no_of_months;; 
      }
      $this->save();
      return $this->average_cost;
  }
}
