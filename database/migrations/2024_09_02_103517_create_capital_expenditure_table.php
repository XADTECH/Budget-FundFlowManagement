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
        Schema::create('capital_expenditure', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_project_id');

            $table->string('type')->nullable();

            $table->string('project')->nullable();
            $table->string('po');
            $table->string('expenses');
            $table->integer('total_number');
            $table->integer('cost');
            $table->string('description');
            $table->string('status');
            $table->decimal('total_cost', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capital_expenditure');
    }
};
