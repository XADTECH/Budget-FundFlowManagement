<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('planned_cash', function (Blueprint $table) {
      $table->id();
      $table
        ->foreignId('project_id')
        ->constrained()
        ->onDelete('cascade');
      $table->decimal('opening_balance', 15, 2);
      $table->decimal('planned_amount', 15, 2);
      $table->decimal('received_amount', 15, 2)->default(0);
      $table->decimal('remaining_balance', 15, 2)->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('planned_cash');
  }
};
