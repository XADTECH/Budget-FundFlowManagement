<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitalExpenditure extends Model
{
    use HasFactory;

    protected $table = 'capital_expenditure';

    protected $fillable = [
        'direct_cost',
        'budget_project',
        'type', 
        'project',
        'po', 
        'expenses', 
        'quantity',
        'total_cost', 
        'description',
        'status'
    ];

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }

    public function calculateTotalCost()
    {
        $this->total_cost = $this->total_number * $this->cost;
        $this->save();
    }

    public static function sumTotalCost($budgetProjectId)
    {
        $total_cost = CapitalExpenditure::where('budget_project_id', $budgetProjectId)
            ->where('approval_status', 'approved') // Only approved salaries
            ->sum('total_cost');

        return $total_cost;
    }
}
