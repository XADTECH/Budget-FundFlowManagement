<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('facility_cost', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('direct_cost_id');
      $table->unsignedBigInteger('budget_project_id');
      $table->string('sn')->default('2.2'); // Default value for 'sn'
      $table->string('type');
      $table->string('project');
      $table->string('contract');
      $table->string('po');
      $table->string('expenses');
      $table->string('description');
      $table->string('status');
      $table->decimal('cost_per_month', 10, 2);
      $table->integer('no_of_staff')->nullable();
      $table->integer('no_of_months');
      $table->decimal('total_cost', 15, 2)->nullable();
      $table->decimal('average_cost', 15, 2)->nullable();
      $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('approved');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('facilities_cost');
  }
};