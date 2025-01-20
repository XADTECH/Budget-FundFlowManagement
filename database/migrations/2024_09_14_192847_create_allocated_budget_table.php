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
            $table->decimal('committed_allocated_salary', 15, 2)->default(0); // New field for committed salary
            $table->decimal('total_facility_cost', 15, 2)->default(0);
            $table->decimal('committed_allocated_facility_cost', 15, 2)->default(0); // New field for committed facilities
            $table->decimal('total_material_cost', 15, 2)->default(0);
            $table->decimal('committed_allocated_material_cost', 15, 2)->default(0); // New field for committed material
            $table->decimal('total_cost_overhead', 15, 2)->default(0);
            $table->decimal('committed_allocated_cost_overhead', 15, 2)->default(0); // New field for committed overhead
            $table->decimal('total_financial_cost', 15, 2)->default(0);
            $table->decimal('committed_allocated_financial_cost', 15, 2)->default(0); // New field for committed financial
            $table->decimal('total_capital_expenditure', 15, 2)->default(0);
            $table->decimal('committed_allocated_capital_expenditure', 15, 2)->default(0); // New field for committed capital expenditure
            $table->decimal('allocated_budget', 15, 2)->default(0);  
            $table->decimal('committed_allocated_budget', 15, 2)->default(0);  
            $table->decimal('initial_allocation_budget', 15, 2)->default(0);  
            $table->decimal('remaining_fund', 10, 2)->default(0)->nullable();
            $table->decimal('committed_remaining_fund', 10, 2)->default(0)->nullable();
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

