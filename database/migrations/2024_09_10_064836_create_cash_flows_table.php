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
            $table->unsignedBigInteger('budget_project_id');
            $table->enum('type', ['inflow', 'outflow']);
            $table->decimal('amount', 15, 2);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('budget_project_id')->references('id')->on('budget_project')->onDelete('cascade');
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
