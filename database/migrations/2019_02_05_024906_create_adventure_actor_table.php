<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdventureActorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adventure_actors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adventure_encounter_id')->unsigned();
            $table->enum('actor_type', ['SR_MONSTER', 'CUSTOM_MONSTER', 'PC']);
            $table->integer('target_id')->unsigned()->index();
            $table->mediumText('sr_monster')->nullable();
            $table->enum('status', ['ALIVE', 'DEAD'])->default('ALIVE');
            $table->tinyInteger('initiative')->unsigned();
            $table->boolean('has_acted')->default(false);
            $table->integer('current_hp')->unsigned();
            $table->integer('max_hp')->unsigned();
            $table->timestamps();
            
            $table->foreign('adventure_encounter_id')->references('id')->on('adventure_encounters')->onDelete('cascade');
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
        Schema::dropIfExists('adventure_actor');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
