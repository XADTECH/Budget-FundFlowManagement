<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankBalancesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bank_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_id')->constrained();
            $table->unsignedBigInteger('budget_project_id');
            $table->string('fund_category')->nullable(); // Optional for fund categories
            $table->decimal('current_balance', 15, 2)->default(0); // Project-specific balance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bank_balances');
    }
}

