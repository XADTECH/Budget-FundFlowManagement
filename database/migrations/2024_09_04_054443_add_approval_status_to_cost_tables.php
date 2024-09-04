<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalStatusToCostTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->string('approval_status')->default('pending');
        });

        Schema::table('facility_cost', function (Blueprint $table) {
            $table->string('approval_status')->default('pending');
        });

        Schema::table('material_cost', function (Blueprint $table) {
            $table->string('approval_status')->default('pending');
        });

        Schema::table('cost_overhead', function (Blueprint $table) {
            $table->string('approval_status')->default('pending');
        });

        Schema::table('financial_cost', function (Blueprint $table) {
            $table->string('approval_status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });

        Schema::table('facility_cost', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });

        Schema::table('material_cost', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });

        Schema::table('cost_overhead', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });

        Schema::table('financial_cost', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }
}
