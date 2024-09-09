<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
