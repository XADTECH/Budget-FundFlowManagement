<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number');
            $table->string('supplier_name');
            $table->string('description');
            $table->string('supplier_address');
            $table->unsignedBigInteger('project_id');
            $table->decimal('total_discount', 10, 2)->nullable();
            $table->unsignedBigInteger('requested_by');
            $table->string('verified_by')->nullable();
            $table->unsignedBigInteger('prepared_by');
            $table->date('date');
            $table->string('payment_term');
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('vat', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('budget_total', 10, 2)->nullable();
            $table->decimal('budget_utilization', 10, 2)->nullable();
            $table->decimal('budget_balance', 10, 2)->nullable();
            $table->decimal('current_request', 10, 2)->nullable();
            $table->string('status')->default('Not Submitted')->nullable(); // New field for status
            $table->boolean('is_verified')->default(false); // Add this line for verification status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
