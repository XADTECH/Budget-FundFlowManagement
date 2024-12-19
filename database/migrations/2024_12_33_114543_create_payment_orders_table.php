<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id();
            $table->string('payment_order_number')->unique();
            $table->date('payment_date');
            $table->string('payment_method')->nullable();
            $table->string('currency')->nullable();
            $table->string('company_name')->nullable();
            $table->unsignedBigInteger('budget_project_id')->nullable();
            $table->string('beneficiary_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('bank_name')->nullable();
            $table->decimal('cash_amount', 15, 2)->nullable();
            $table->unsignedBigInteger('bank_payment_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('cash_detail')->nullable();
            $table->string('bank_detail')->nullable();
            $table->string('submit_status')->nullable();
            $table->text('bank_transfer_details')->nullable();
            $table->string('cash_received_by')->nullable();
            $table->json('item_amount')->nullable(); // Store item_amount as JSON
            $table->json('item_description')->nullable(); // Store item_status as JSON
            $table->date('cash_date')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('paid_status')->default('not paid yet');
            $table->string('transaction_detail')->nullable();
            $table->decimal('transaction_amount', 15, 2)->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('status')->default('pending');
            $table->date('cheque_date')->nullable();
            $table->string('cheque_file')->nullable();
            $table->string('cheque_payee')->nullable();
            $table->decimal('total_budget', 15, 2)->nullable();
            $table->decimal('total_cheque_amount', 15, 2)->nullable();
            $table->decimal('utilization', 15, 2)->nullable();
            $table->decimal('total_bank_transfer', 15, 2)->nullable();
            $table->decimal('balance', 15, 2)->nullable();
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_orders');
    }
}
