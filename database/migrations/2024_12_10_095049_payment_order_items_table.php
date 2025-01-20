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
        Schema::create('payment_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_order_id');
            $table->unsignedBigInteger('budget_project_id')->nullable();
            $table->json('items_json')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_order_items');
    }
};
