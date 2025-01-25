<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrderModel extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'payment_orders';

    protected $fillable = [
        'payment_order_number',
        'payment_date',
        'payment_method',
        'budget_project_id',
        'beneficiary_name',
        'iban',
        'bank_name',
        'bank_transfer_details',
        'total_bank_transfer',
        'cash_received_by',
        'cash_date',
        'transaction_number',
        'transaction_detail',
        'transaction_amount',
        'cheque_number',
        'cheque_date',
        'cheque_file',
        'total_cheque_amount',
        'cash_amount',
        'item_description',
        'item_amount',
        'bank_payment_id',
        'cash_detail',
        'submit_status',
        'cheque_payee',
        'total_budget',
        'utilization',
        'balance',
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
