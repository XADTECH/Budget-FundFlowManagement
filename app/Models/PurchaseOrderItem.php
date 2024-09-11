<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'purchase_order_items';

    // The attributes that are mass assignable
    protected $fillable = [
        'purchase_order_id',
        'item_code',
        'description',
        'quantity',
        'unit_price',
        'total',
        'items',
        'status',
        'total_amount',
        'total_discount',
        'total_vat',
        'po_number'
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'total_discount' => 'decimal:2',
        'total_vat' => 'decimal:2',
    ];

    // Define the relationship with the PurchaseOrder model
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
