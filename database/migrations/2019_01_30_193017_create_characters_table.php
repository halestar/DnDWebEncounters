<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned();
            $table->string('name');
            $table->string('characterClass')->nullable();
            $table->string('characterRace')->nullable();
	        $table->integer('ac');
	        $table->integer('hp');
	        $table->integer('pp');
	        $table->integer('level');
	        $table->integer('spellDc')->nullable();
	        $table->timestamps();
            
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
