<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up()
  {
      Schema::create('material_cost', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('direct_cost_id');
        $table->unsignedBigInteger('budget_project_id');
        $table->string('sn')->default('2.3'); // Default value for 'sn'
        $table->string('type'); // Type of record (e.g., Material/Cost)
        $table->string('project'); // Project name
        $table->string('po'); // Type of expense (e.g., OPEX)
        $table->string('expenses'); // Specific expense (e.g., Salary, Materials)
        $table->string('contract')->nullable(); // Contract information, if applicable
        $table->string('description'); // Description of the material or details
        $table->string('status'); // Status of the budget entry (e.g., New Hiring, Purchased)
        
        // New fields for material management
        $table->decimal('quantity', 10, 2)->nullable(); // Amount of material (e.g., 100, 50)
        $table->string('unit')->nullable(); // Unit of measurement (e.g., meters, units, liters)
        $table->decimal('unit_cost', 10, 2)->nullable(); // Cost per unit of the material (e.g., 100 per meter)
        
        // Updated total and average cost fields
        $table->decimal('total_cost', 15, 2)->nullable(); // Total cost calculated dynamically
        $table->decimal('average_cost', 15, 2)->nullable(); // Average cost per unit, if needed
        
        $table->timestamps();
    });
  
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('material_cost');
  }
};