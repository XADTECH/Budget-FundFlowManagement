<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['bank_name', 'iban', 'account', 'swift_code', 'bank_address', 'branch', 'rm_detail', 'balance_amount','country','region'];
    /**
     * Relationship with LedgerEntry model.
     * A bank can have multiple ledger entries (debits/credits).
     */
    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class);
    }
}
