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
    Schema::create('material_cost', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('direct_cost_id');
      $table->unsignedBigInteger('budget_project_id');
      $table->string('sn')->default('2.3'); // Default value for 'sn'
      $table->string('type');
      $table->string('project');
      $table->string('po');
      $table->string('expenses');
      $table->string('contract');
      $table->string('description');
      $table->string('status');
      $table->decimal('cost_per_month', 10, 2);
      $table->integer('no_of_staff');
      $table->integer('no_of_months');
      $table->decimal('total_cost', 15, 2)->nullable();
      $table->decimal('average_cost', 15, 2)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('material_cost');
  }
};
