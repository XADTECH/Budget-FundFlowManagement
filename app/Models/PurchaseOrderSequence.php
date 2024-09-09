<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderSequence extends Model
{
    protected $table = 'purchase_order_sequence';

    protected $fillable = [
        'date',
        'last_sequence',
    ];
}
