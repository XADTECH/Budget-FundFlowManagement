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
        'approval_status',
      ];

    public function budgetProject()
    {
      return $this->belongsTo(BudgetProject::class);
    }

    // Calculate total cost dynamically
    public function calculateTotalCost()
    {
        // Ensure cost_per_month is a positive value
        if ($this->cost_per_month > 0) {
            // Case 1: Both staff and months are greater than 0
            if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
                $this->total_cost = $this->cost_per_month * $this->no_of_staff * $this->no_of_months;
            }
            // Case 2: Staff > 0 but no months provided (default to 1 month)
            elseif ($this->no_of_staff > 0 && $this->no_of_months == 0) {
                $this->total_cost = $this->cost_per_month * $this->no_of_staff;
            }
            // Case 3: No staff but months provided (default to 1 staff member)
            elseif ($this->no_of_staff == 0 && $this->no_of_months > 0) {
                $this->total_cost = $this->cost_per_month * $this->no_of_months;
            }
            // Case 4: Both staff and months are zero, total cost should be zero
            else {
                $this->total_cost = $this->cost_per_month;
            }
        } else {
            // Case where cost_per_month is zero or invalid, set total cost to 0
            $this->total_cost = 0;
        }

        // Save the updated total cost to the database
        $this->save();
        return $this->total_cost;
    }

  // Calculate average cost dynamically
  // Calculate average cost dynamically
  public function calculateAverageCost()
  {
      if ($this->no_of_staff > 0 && $this->no_of_months > 0) {
          // Use no_of_staff and no_of_months for calculation
          $this->average_cost = $this->total_cost / ($this->no_of_staff * $this->no_of_months);
      } elseif ($this->no_of_months > 0) {
          // Fallback to dividing total_cost by no_of_months if no_of_staff is null or 0
          $this->average_cost = $this->total_cost / $this->no_of_months;
      } else {
          // Default value if no_of_months is also null or 0
          $this->average_cost = $this->total_cost; // Or another default value
      }

      $this->save();
      return $this->average_cost;
  }

  public static function sumTotalCost($budgetProjectId)
  {
     $total_cost = CapitalExpenditure::where('budget_project_id', $budgetProjectId)
     ->where('approval_status', 'approved') // Only approved salaries
     ->sum('total_cost');

     return $total_cost;
  }
}
