<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrderModel extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'payment_orders';

    // Mass assignable attributes
    protected $fillable = [
        'payment_order_number',
        'payment_date',
        'payment_method',
    ];

    /**
     * Generate a unique Payment Order number
     *
     * @param string $paymentMethod
     * @param string $date
     * @return string
     */
    public static function generatePaymentOrderNumber($paymentMethod, $date)
    {
        $formattedDate = \Carbon\Carbon::parse($date)->format('dmy'); // Format date to DDMMYYYY
        $formattedMethod = strtoupper(str_replace(' ', '-', $paymentMethod)); // Replace spaces with dashes and uppercase
        return "PO{$formattedDate}-{$formattedMethod}";
    }
}