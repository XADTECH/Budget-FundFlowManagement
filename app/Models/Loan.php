<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_reference',
        'loan_provider_type',
        'loan_provider_name',
        'loan_amount',
        'loan_interest_rate',
        'loan_bank_account',
        'fund_category',
        'loan_repayment_start_date',
        'loan_repayment_frequency',
        'loan_destination_account',
        'budget_project_id',
        'loan_date',
        'loan_description',
    ];

    // Relationships
    public function destinationAccount()
    {
        return $this->belongsTo(Bank::class, 'loan_destination_account');
    }

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
    }
}
