<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampOrderFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('street')->nullable();
            $table->string('company')->nullable();
            $table->string('tin')->nullable();
            $table->string('insurance')->nullable();
            $table->string('pid_number')->nullable();
            $table->string('condition')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('street');
            $table->dropColumn('company');
            $table->dropColumn('tin');
            $table->dropColumn('insurance');
            $table->dropColumn('pid_number');
            $table->dropColumn('condition');
        });
    }
}
