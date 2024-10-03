<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierPrice extends Model
{

    use HasFactory;

    protected $table = 'supplier_prices'; // Explicitly specify the table name
    protected $fillable = [
        'items_code',
        'purchase_date',
        'item_name',
        'supplier_name',
        'uom',
        'price',
        'discount',
        'remarks',
    ];
}
