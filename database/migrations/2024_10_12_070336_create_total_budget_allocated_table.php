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
        Schema::create('total_budget_allocated', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_project_id'); 
            $table->decimal('approved_budget', 15, 2)->default(0); 
            $table->decimal('total_budget_allocated', 15, 2)->default(0);
            $table->decimal('total_budget_utilized', 15, 2)->default(0);
            $table->string('duration')->nullable();
            $table->string('expense_head')->nullable();
            $table->string('reference_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_budget_allocated');
    }
};
