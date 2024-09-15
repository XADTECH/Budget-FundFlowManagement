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
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('description');
            $table->string('category');
            $table->string('reference_code');
            $table->decimal('cash_inflow', 10, 2)->nullable();
            $table->decimal('cash_outflow', 10, 2)->nullable();
            $table->decimal('committed_budget', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();
            $table->unsignedBigInteger('budget_project_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
        public function down()
        {
            Schema::dropIfExists('cash_flows');
        }
    
};
