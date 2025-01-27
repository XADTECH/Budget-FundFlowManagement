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
        'items',                // JSON field to store item details
        'project_id',           // Nullable, if applicable
        'initial_allocated_budget',
        'budget_utilization',
        'remaining_balance',
        'requested_amount',
        'total_balance_budget',
        'total_vat',
        'total_discount',
        'vat_value',
        'discount_value',
        'delivery_charges',
        'total_amount',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'items'                  => 'array',
        'initial_allocated_budget' => 'decimal:2',
        'budget_utilization'     => 'decimal:2',
        'remaining_balance'      => 'decimal:2',
        'requested_amount'       => 'decimal:2',
        'total_balance_budget'   => 'decimal:2',
        'total_vat'             => 'decimal:2',
        'total_discount'         => 'decimal:2',
        'vat_value'             => 'decimal:2',
        'discount_value'         => 'decimal:2',
        'delivery_charges'       => 'decimal:2',
        'total_amount'           => 'decimal:2',
    ];

    // Define relationship with the PurchaseOrder model
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
