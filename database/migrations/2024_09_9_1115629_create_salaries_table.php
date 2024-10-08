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
            $table->string('type');
            $table->string('project');
            $table->string('po')->default('OPEX'); // Set the default value to 'OPEX'
            $table->string('expenses'); 
            $table->string('description');
            $table->string('other_expense')->nullable();
            $table->string('status');
            $table->string('visa_status')->default("xad_visa");
            $table->decimal('cost_per_month', 10, 2);
            $table->integer('no_of_staff');
            $table->integer('overseeing_sites')->default(0);
            $table->integer('no_of_months');
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->decimal('average_cost', 15, 2)->nullable();
            $table->decimal('percentage_cost', 15, 2)->default(0);
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
        Schema::dropIfExists('salaries');
    }
}
