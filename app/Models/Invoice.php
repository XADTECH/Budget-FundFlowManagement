<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Define the table name if it's not pluralized
    protected $table = 'invoice';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'date',
        'invoice_number',
        'invoice_dr_amount_received',
        'invoice_destination_account',
        'fund_type',
        'item_description',
        'amount',
        'invoice_file',
        'invoice_budget_project_id',
    ];

    // Specify the fields that should be cast to specific types
    protected $casts = [
        'item_description' => 'array', // Cast JSON column to array
        'amount' => 'array', // Cast JSON column to array
        'fund_type' => 'array', // Automatically casts JSON to array

    ];

    // Define any relationships (if applicable)
    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'invoice_budget_project_id');
    }

    public function destinationAccount()
    {
        return $this->belongsTo(Bank::class, 'invoice_destination_account');
    }
}
