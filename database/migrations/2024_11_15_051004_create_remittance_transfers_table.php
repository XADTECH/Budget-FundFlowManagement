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
        Schema::create('remittance_transfers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('remittance_reference')->unique();
            $table->string('remittance_payer_name');
            $table->decimal('remittance_amount', 15, 2); // Supports large amounts with 2 decimal places
            $table->string('remittance_sender_bank');
            $table->string('remittance_account_number');
            $table->string('remittance_destination_account');
            $table->string('fund_category');
            $table->unsignedBigInteger('budget_project_id')->nullable();
            $table->date('remittance_date_received');
            $table->string('remittance_currency', 10);
            $table->text('remittance_description')->nullable();
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remittance_transfers');
    }
};
