<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_reference')->unique();
            $table->string('loan_provider_type'); // e.g., 'bank', 'director', 'external'
            $table->string('loan_provider_name'); // Name of the bank or provider
            $table->decimal('loan_amount', 15, 2); // Loan amount with precision
            $table->decimal('loan_interest_rate', 5, 2)->nullable(); // Interest rate (percentage)
            $table->string('loan_bank_account'); // Bank account for loan processing
            $table->string('fund_category'); // e.g., 'Finance', 'Overhead'
            $table->date('loan_repayment_start_date')->nullable(); // Optional repayment start date
            $table->string('loan_repayment_frequency'); // e.g., 'Monthly', 'Quarterly'
            $table->unsignedBigInteger('loan_destination_account')->nullable(); // Foreign key for destination account
            $table->unsignedBigInteger('budget_project_id')->nullable(); // Foreign key for budget project
            $table->date('loan_date'); // Date of the loan agreement
            $table->text('loan_description')->nullable(); // Purpose/Description of the loan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
