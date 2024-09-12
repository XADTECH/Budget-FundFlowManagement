<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_project_id');
            $table->integer('sn')->default(1.1);  // Serial number
            $table->string('type');
            $table->string('project')->nullable();
            $table->string('contract')->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2); // Revenue amount
            $table->decimal('total_profit', 15, 2)->nullable();
            $table->decimal('net_profit_before_tax', 15, 2)->nullable();
            $table->decimal('tax', 15, 2)->nullable();
            $table->decimal('net_profit_after_tax', 15, 2)->nullable();
            $table->decimal('profit_percentage', 8, 4)->nullable();
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
        Schema::dropIfExists('revenue_plans');
    }
}
