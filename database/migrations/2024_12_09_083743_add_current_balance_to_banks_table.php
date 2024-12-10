<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentBalanceToBanksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->decimal('current_balance', 15, 2)->default(0)->after('account'); // Adding the current_balance field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->dropColumn('current_balance');
        });
    }
}

