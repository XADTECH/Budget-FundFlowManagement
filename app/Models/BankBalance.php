<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBalance extends Model
{
    use HasFactory;

    protected $fillable = ['bank_id', 'budget_project_id', 'fund_category', 'current_balance'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }
}
