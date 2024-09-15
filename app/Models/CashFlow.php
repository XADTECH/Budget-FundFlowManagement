<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'category',
        'cash_inflow',
        'cash_outflow',
        'committed_budget',
        'balance',
        'reference_code',
        'budget_project_id', // Reference to BudgetProject
    ];

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
    }
}
