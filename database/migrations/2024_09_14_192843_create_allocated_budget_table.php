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
        Schema::create('allocated_budget', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_project_id');
            $table->decimal('total_salary', 15, 2)->default(0);
            $table->decimal('total_facility_cost', 15, 2)->default(0);
            $table->decimal('total_material_cost', 15, 2)->default(0);
            $table->decimal('total_cost_overhead', 15, 2)->default(0);
            $table->decimal('total_financial_cost', 15, 2)->default(0);
            $table->decimal('total_capital_expenditure', 15, 2)->default(0);
            $table->decimal('allocated_budget', 15, 2)->default(0);  
            $table->decimal('total_dpm', 15, 2)->default(0);  
            $table->decimal('total_lpo', 15, 2)->default(0);   
            $table->string('reference_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocated_budget');
    }
};
