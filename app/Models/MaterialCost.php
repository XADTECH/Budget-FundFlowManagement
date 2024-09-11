<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCost extends Model
{
    use HasFactory;

    protected $table = 'material_cost';

    protected $fillable = [
        'direct_cost_id', // Foreign key reference to DirectCost
        'budget_project_id',
        'sn', // Serial number or identifier
        'type', // Type of record (Material/Cost)
        'project', // Project name
        'po', // Type of expense (e.g., OPEX)
        'expenses', // Specific expense (e.g., Salary, Materials)
        'description', // Description of the material or details
        'status', // Status of the budget entry (e.g., New Hiring, Purchased)
        'quantity', // Amount of material (e.g., 100, 50)
        'unit', // Unit of measurement (e.g., meters, units, liters)
        'unit_cost', // Cost per unit of the material (e.g., 100 per meter)
        'total_cost', // Total calculated cost (quantity * unit_cost)
        'average_cost', // Average cost per unit, if needed
        'total_budget', // Total budget allocated
        'total_budget_allocated', // Total of each entry
        'approval_status', // Approval status
        'approved_by', // ID of the user who approved
        'total_budget', // Total budget allocated
        'total_budget_allocated', // Total of each entry
        'approval_status', // Approval status
        'approved_by', // ID of the user who approved
    ];

    public function directCost()
    {
        return $this->belongsTo(DirectCost::class);
    }

        // Update total budget and allocation
     // Update total budget and allocation
public function updateBudget()
{
    // Fetch the current total budget and total allocated budget from the database
    $current_total_budget = MaterialCost::where('budget_project_id', $this->budget_project_id)
                                  ->sum('total_budget');

    $current_total_budget_allocated = MaterialCost::where('budget_project_id', $this->budget_project_id)
                                            ->sum('total_budget_allocated');

    // Update total budget by adding new total cost to the existing budget
    $this->total_budget = $current_total_budget + $this->total_cost;

    // Update total budget allocated similarly
    $this->total_budget_allocated = $current_total_budget_allocated + $this->total_cost;

    // Save the updated budget and allocation
    $this->save();
}
    

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }

    // Calculate total cost dynamically
    public function calculateTotalCost()
    {
        $this->total_cost = $this->quantity * $this->unit_cost;
        $this->save();
        return $this->total_cost;
    }

    // Calculate average cost dynamically (optional)
    public function calculateAverageCost()
    {
        if ($this->quantity > 0) {
            $this->average_cost = $this->total_cost / $this->quantity;
            $this->save();
        } else {
            $this->average_cost = 0;
        }
        return $this->average_cost;
    }

   
    
}
