<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferFromManagement extends Model
{
    use HasFactory;

    protected $table = 'transfer_from_management';

    protected $fillable = [
        'date_received',
        'transfer_reference',
        'fund_category',
        'source_account',
        'transfer_amount',
        'sender_bank_name',
        'transfer_date',
        'budget_project_id',
        'transfer_description',
        'transfer_designation',
        'transfer_destination_account'
    ];

    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class);
    }
}
