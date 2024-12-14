<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrderItem extends Model
{
    use HasFactory;

    protected $table = 'payment_order_items';

    protected $fillable = [
        'payment_order_id',
        'items_json',
        'currency'
    ];

    public function order()
    {
        return $this->belongsTo(PaymentOrderModel::class, 'payment_order_id');
    }
}
