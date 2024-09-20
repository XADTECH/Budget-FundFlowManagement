<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('noc_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id'); // Assuming NOC payment is tied to a project
            $table->string('description')->nullable();
            $table->decimal('amount', 15, 2); // NOC payment amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noc_payments');
    }
};
