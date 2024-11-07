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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->text('bank_address')->nullable(); // Changed to text for more flexibility in address details
            $table->string('iban')->nullable(); // IBAN for bank transfers
            $table->string('account')->nullable(); // Account number
            $table->string('swift_code')->nullable(); // SWIFT code
            $table->string('branch')->nullable(); // Bank branch
            $table->text('rm_detail')->nullable(); // Relationship Manager detail (consolidated info)
            $table->text('country')->nullable(); 
            $table->text('region')->nullable(); 
            $table->decimal('balance_amount', 15, 2)->default(0); // Balance with a default value of 0
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
