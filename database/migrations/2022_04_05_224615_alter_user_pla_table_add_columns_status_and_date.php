<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserPlaTableAddColumnsStatusAndDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_plan', function (Blueprint $table) {
            $table->string('status');
            $table->dateTime('date_subscription')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('user_plan', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('date_subscription');
        });
    }
}
