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
            $table->unsignedBigInteger('budget_project_id'); // To link with the project
            $table->decimal('total_budget_allocated', 15, 2)->default(0); // Total allocated budget
            $table->string('expense_head'); // Total allocated budget
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
