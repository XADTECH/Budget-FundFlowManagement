<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemittanceTransfer extends Model
{
    use HasFactory;

    protected $table = 'remittance_transfers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'remittance_reference',
        'remittance_payer_name',
        'remittance_amount',
        'remittance_sender_bank',
        'remittance_account_number',
        'remittance_destination_account',
        'fund_category',
        'budget_project_id',
        'remittance_date_received',
        'remittance_currency',
        'remittance_description',
    ];

    // Example: If this is related to BudgetProject
    public function budgetProject()
    {
        return $this->belongsTo(BudgetProject::class, 'budget_project_id');
    }
}
