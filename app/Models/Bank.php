<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'bank_name',
        'iban',
        'account',
        'swift_code',
        'bank_address',
        'branch',
        'rm_detail',
        'balance_amount',
        'current_balance', // New field for overall bank balance
        'country',
        'region'
    ];

    /**
     * Relationship with LedgerEntry model.
     * A bank can have multiple ledger entries (debits/credits).
     */
    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class);
    }

    /**
     * Relationship with BankBalance model.
     * A bank can have multiple project-specific balances.
     */
    public function bankBalances()
    {
        return $this->hasMany(BankBalance::class);
    }
}
