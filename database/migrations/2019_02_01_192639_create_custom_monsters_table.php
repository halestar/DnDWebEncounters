<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_monsters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
	        $table->string('name');
	        $table->string('cr');
	        $table->string('monsterType')->nullable();
	        $table->string('monsterSize')->nullable();
	        $table->string('alignment')->nullable();
	        $table->string('resistances')->nullable();
	        $table->string('immunities')->nullable();
	        $table->string('vulnerabilities')->nullable();
	        $table->string('languages')->nullable();
	        $table->string('senses')->nullable();
	        $table->integer('str');
	        $table->integer('dex');
	        $table->integer('con');
	        $table->integer('int');
	        $table->integer('wis');
	        $table->integer('cha');
	        $table->integer('hp');
	        $table->integer('ac');
	        $table->string('speed');
            $table->timestamps();
	
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_monsters');
    }
}
