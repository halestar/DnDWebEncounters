<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdventureEncountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adventure_encounters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('play_session_id')->unsigned();
            $table->integer('encounter_id')->unsigned();
            $table->boolean('encounter_setup')->default(false);
            $table->boolean('encounter_completed')->default(false);
            $table->boolean('monster_initiative')->default(false);
            $table->boolean('monster_hp')->default(false);
            $table->tinyInteger('turn_number')->unsigned()->default(0);
            $table->tinyInteger('current_initiative')->unsigned()->nullable();
            
            $table->timestamps();
            $table->foreign('play_session_id')->references('id')->on('play_sessions')->onDelete('cascade');
            $table->foreign('encounter_id')->references('id')->on('encounters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('adventure_encounters');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
