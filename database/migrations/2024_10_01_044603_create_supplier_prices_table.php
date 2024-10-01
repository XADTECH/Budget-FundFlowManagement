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
            $table->string('items_code');
            $table->date('purchase_date');
            $table->string('item_name');
            $table->string('supplier_name');
            $table->string('uom');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->text('remarks')->nullable();
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
