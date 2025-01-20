<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseOrderItem;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = "purchase_orders";

    protected $fillable = [
        'po_number',
        'supplier_name',
        'supplier_address',
        'project_id',
        'requested_by',
        'verified_by',
        'date',
        'payment_term',
        'subtotal',
        'vat',
        'total',
        'budget_total',
        'budget_utilization',
        'budget_balance',
        'current_request',
        'is_verified',
        'status'
    ];

    // Define any relationships here, e.g., if you have a Project model
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    // Define the relationship with the PurchaseOrderItem model
    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'po_number', 'po_number');
    }
}
