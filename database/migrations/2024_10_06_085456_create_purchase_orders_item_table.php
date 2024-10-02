<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_orders_item', function (Blueprint $table) {
            // Add new fields
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->string('po_number');
            $table->json('items'); // JSON field to store item details
            $table->unsignedBigInteger('project_id')->nullable();
            $table->decimal('allocated_budget_amount')->default(0);
            $table->decimal('amount_requested', 10, 2)->default(0);
            $table->decimal('total_vat', 10, 2)->default(0);
            $table->decimal('total_discount', 10, 2)->default(0);
            $table->decimal('balance_budget')->default(0);
            $table->decimal('total_balance')->default(0);
            $table->decimal('budget_utilization')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders_item');
    }
};
