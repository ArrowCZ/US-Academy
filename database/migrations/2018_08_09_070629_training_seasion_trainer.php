<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrainingSeasionTrainer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->string('trainer');
            $table->string('season');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('trainer');
            $table->dropColumn('season');
        });
    }
}
