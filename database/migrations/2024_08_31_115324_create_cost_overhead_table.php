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
    Schema::create('cost_overhead', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('in_direct_cost_id');
      $table->unsignedBigInteger('budget_project_id');
      $table->string('type');
      $table->string('project');
      $table->string('po');
      $table->string('expenses');
      $table->decimal('amount', 10, 2);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cost_overhead');
  }
};
