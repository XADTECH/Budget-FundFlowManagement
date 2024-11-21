<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('payment_order_number')->unique(); // Unique Payment Order number (e.g., PO201124-CASH)
            $table->date('payment_date'); // Payment date
            $table->string('payment_method'); // Payment method (cash, online transaction, etc.)
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_orders');
    }
}
