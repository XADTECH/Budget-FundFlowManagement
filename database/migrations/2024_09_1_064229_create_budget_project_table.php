<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetProjectTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('budget_project', function (Blueprint $table) {
      $table->id();
      $table->string('reference_code')->unique();
      $table->date('start_date');
      $table->date('end_date');
      $table->unsignedBigInteger('project_id');
      $table->unsignedBigInteger('unit_id');
      $table->unsignedBigInteger('manager_id');
      $table->unsignedBigInteger('client_id');
      $table->string('region')->nullable();
      $table->string('site_name')->nullable();
      $table->string('description')->nullable();
      $table->string('budget_type');
      $table->string('country');
      $table->string('month');
      $table
        ->string('approval_status')
        ->default('pending')
        ->nullable(); // Assuming default status
      $table->decimal('daily_payment_expense', 15, 2)->nullable();
      $table->decimal('lpo_amount', 15, 2)->nullable();
      $table->decimal('bal_under_over_budget', 15, 2)->nullable();
      $table->decimal('total_budget_allocated', 15, 2)->nullable();
      $table->decimal('total_dpm_expense', 15, 2)->nullable();
      $table->decimal('total_lpo_expense', 15, 2)->nullable();
      $table->decimal('total_budget', 15, 2)->nullable();
      $table
        ->string('status')
        ->default('Good')
        ->nullable(); // Assuming default status
      $table->timestamps();

      // Foreign key constraint if 'manager_id' references a user or manager table
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('budget_project');
  }
}
