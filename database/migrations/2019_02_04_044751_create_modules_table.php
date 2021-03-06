<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('uuid')->nullable()->default(null)->index();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->tinyInteger('tier', false, true);
            $table->tinyInteger('optimized_level', false, true);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
