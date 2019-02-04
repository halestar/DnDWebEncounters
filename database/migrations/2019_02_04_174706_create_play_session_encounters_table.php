<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaySessionEncountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_session_encounters', function (Blueprint $table) {
	        $table->integer('play_session_id')->unsigned();
	        $table->integer('encounter_id')->unsigned();
	        $table->boolean('complete')->default(false);
	        $table->date('completed')->nullable();
	
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
        Schema::dropIfExists('play_session_encounters');
    }
}
