<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonsterAbilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_ability', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('monster_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->enum('type', ['SPECIAL ABILITY', 'ACTION', 'LEGENDARY ABILITY']);
            $table->timestamps();
            
	        $table->foreign('monster_id')->references('id')->on('custom_monsters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monster_ability');
    }
}
