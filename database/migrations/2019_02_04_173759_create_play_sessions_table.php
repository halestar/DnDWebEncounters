<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_sessions', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('user_id')->unsigned();
            $table->integer('current_encounter_id')->unsigned()->nullable();
	        $table->integer('party_id')->unsigned()->nullable();
	        $table->integer('module_id')->unsigned()->nullable();
            $table->date('ended')->nullable();
            
            $table->timestamps();
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	        $table->foreign('current_encounter_id')->references('id')->on('encounters')->onDelete('set null');
	        $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');
	        $table->foreign('party_id')->references('id')->on('party')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('play_sessions');
    }
}
