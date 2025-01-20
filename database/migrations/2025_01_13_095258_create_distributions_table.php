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
        Schema::create('distributions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('project_id'); // Foreign key to projects table
            $table->string('head'); // Distribution head (e.g., salary, facility, etc.)
            $table->decimal('total_amount', 15, 2)->default(0); // Cumulative total amount for the head
            $table->timestamps();
            
            // Prevent duplicate records for the same project and head
            $table->unique(['project_id', 'head']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
