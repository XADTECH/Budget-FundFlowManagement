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
    ];

    public function directCost()
    {
        return $this->belongsTo(DirectCost::class);
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
