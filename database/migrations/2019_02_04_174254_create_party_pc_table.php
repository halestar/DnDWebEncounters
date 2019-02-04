<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartyPcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_pc', function (Blueprint $table) {
            $table->integer('party_id')->unsigned();
	        $table->integer('character_id')->unsigned();
	        
	        $table->foreign('party_id')->references('id')->on('party')->onDelete('cascade');
	        $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_pc');
    }
}
