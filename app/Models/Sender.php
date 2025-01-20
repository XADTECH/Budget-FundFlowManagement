<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    use HasFactory;

    // Define the table if it's different from the pluralized model name
    protected $table = 'sender'; // Since the table name is singular

    // Define which fields are mass-assignable
    protected $fillable = [
        'date',
        'sender_name',
        'sender_for',
        'sender_bank_name',
        'sender_bank_account',
        'tracking_number',
        'fund_type',
        'amount',
        'destination_account',
        'sender_detail',  // Optional field for additional fund-specific details
        'budget_project_id',  // Foreign key to link the sender to a budget project
    ];

    protected $casts = [
        'fund_type' => 'array', // Automatically casts JSON to array
    ];

    // Relationship with BudgetProject (if applicable)
    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id'); // Assuming you have a BudgetProject model
    }
}
