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
        Schema::create('sender', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('sender_name'); 
            $table->string('sender_for'); 
            $table->string('sender_bank_name'); 
            $table->string('sender_bank_account'); 
            $table->string('tracking_number'); 
            $table->string('amount'); 
            $table->string('fund_type'); 
            $table->string('sender_detail')->nullable(); 
            $table->unsignedBigInteger('budget_project_id');
            $table->unsignedBigInteger('destination_account');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sender');
    }
};
