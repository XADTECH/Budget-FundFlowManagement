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
        'approval_status', // Approval status

    ];

    public function directCost()
    {
        return $this->belongsTo(DirectCost::class);
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }

       // Define the relationship with TotalBudgetAllocated based on the project
       public function totalBudgetAllocated()
       {
           return $this->hasOne(TotalBudgetAllocated::class, 'budget_project_id');
       }


   // Update total budget and allocation
   public function updateBudget($expenseHead)
   {
       // Fetch or create the total budget allocated for the project
       $totalBudgetAllocated = new TotalBudgetAllocated();

       // Sum the total cost of approved salaries for the given budget_project_id
       $approved_total_cost = MaterialCost::where('budget_project_id', $this->budget_project_id)
                                    ->where('approval_status', 'approved') // Only approved salaries
                                    ->sum('total_cost');

       // Update the total_budget_allocated field in the TotalBudgetAllocated table
       $totalBudgetAllocated->total_budget_allocated = $approved_total_cost;
       $totalBudgetAllocated->budget_project_id = $this->budget_project_id;
       $totalBudgetAllocated->expense_head = $expenseHead;

       // Save the updated data
       $totalBudgetAllocated->save();
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

    // Approve the material entry
    public function approve()
    {
        $this->approval_status = 'Approved';
        $this->save();
    }

    // Reject the material entry
    public function reject()
    {
        $this->approval_status = 'Rejected';
        $this->save();
    }

    // Mark the material entry as pending
    public function pending()
    {
        $this->approval_status = 'Pending';
        $this->save();
    }

    public static function sumTotalCost($budgetProjectId)
    {
       $total_cost = MaterialCost::where('budget_project_id', $budgetProjectId)
       ->where('approval_status', 'approved') // Only approved salaries
       ->sum('total_cost');

       return $total_cost;
    }
    
}
