<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'purchase_orders_item';

    // The attributes that are mass assignable
    protected $fillable = [
        'purchase_order_id',
        'po_number',
        'items', // JSON field to store item details
        'project_id', // Nullable, if applicable
        'allocated_budget_amount', // As per schema
        'amount_requested', // Corresponds to request_amount
        'total_vat', // Corresponds to total_vat
        'total_discount', // Corresponds to total_discount
        'balance_budget', // Corresponds to budget_balance
        'budget_utilization', // Corresponds to budget_utilization,
        'total_balance'
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
