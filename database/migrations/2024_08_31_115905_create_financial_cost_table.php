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
    Schema::create('financial_cost', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('in_direct_cost_id');
      $table->unsignedBigInteger('budget_project_id');
      $table->string('type');
      $table->string('po'); 
      $table->string('project');
      $table->string('expenses');
      $table->string('percentage');
      $table->decimal('total_cost', 15, 2)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('financial_cost');
  }
};
