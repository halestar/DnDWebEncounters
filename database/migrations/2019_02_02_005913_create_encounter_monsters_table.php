<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncounterMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounter_monsters', function (Blueprint $table) {
            $table->integer('encounter_id')->unsigned();
            $table->integer('custom_monster_id')->unsigned();
	
	        $table->foreign('encounter_id')->references('id')->on('encounters')->onDelete('cascade');
            $table->foreign('custom_monster_id')->references('id')->on('custom_monsters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encounter_monsters');
    }
}
