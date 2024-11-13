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
        Schema::create('transfer_from_management', function (Blueprint $table) {
            $table->id();
            $table->date('date_received');
            $table->string('transfer_reference')->unique();
            $table->string('fund_category');
            $table->string('source_account');
            $table->decimal('transfer_amount', 15, 2);
            $table->string('sender_bank_name');
            $table->string('transfer_designation');
            $table->date('transfer_date');
            $table->unsignedBigInteger('budget_project_id');
            $table->unsignedBigInteger('transfer_destination_account');
            $table->text('transfer_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_from_management');
    }
};
