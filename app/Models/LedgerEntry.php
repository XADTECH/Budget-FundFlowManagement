<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bank_id',
        'amount',
        'type',
        'description',
    ];

    /**
     * Get the bank associated with the ledger entry.
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
