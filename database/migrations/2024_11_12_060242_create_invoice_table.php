<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('invoice_number')->unique(); 
            $table->decimal('invoice_dr_amount_received', 15, 2); 
            $table->unsignedBigInteger('invoice_destination_account'); 
            $table->json('item_description'); 
            $table->json('amount'); 
            $table->json('fund_type')->nullable(); 
            $table->string('invoice_file')->nullable(); 
            $table->unsignedBigInteger('invoice_budget_project_id'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
