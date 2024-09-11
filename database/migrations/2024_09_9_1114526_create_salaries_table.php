<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direct_cost_id');
            $table->unsignedBigInteger('budget_project_id');
            $table->string('sn')->default('2.1'); // Default value for 'sn'
            $table->string('type');
            $table->string('contract');
            $table->string('project');
            $table->string('po');
            $table->string('expenses');
            $table->string('description');
            $table->string('status');
            $table->decimal('cost_per_month', 10, 2);
            $table->integer('no_of_staff');
            $table->integer('no_of_months');
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->decimal('average_cost', 15, 2)->nullable();
            $table->decimal('total_budget', 15, 2)->nullable(); // Total budget allocated
            $table->decimal('total_budget_allocated', 15, 2)->nullable(); // Total of each entry
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('overall_approval', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable(); // ID of the user who approved
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
        Schema::dropIfExists('salaries');
    }
}
