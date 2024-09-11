<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    use HasFactory;

    protected $table= 'cash_flows';

    protected $fillable = [
        'budget_project_id',
        'type',
        'amount',
        'description',
    ];

    /**
     * Get the budget project associated with the cash flow.
     */
    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }
}
