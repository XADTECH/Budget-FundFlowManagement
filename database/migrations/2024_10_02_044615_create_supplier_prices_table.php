<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('supplier_prices', function (Blueprint $table) {
            $table->id();
            $table->string('items_code')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('item_name')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('uom')->nullable();
            $table->string('price')->nullable();
            $table->text('discount')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_prices');
    }
};
