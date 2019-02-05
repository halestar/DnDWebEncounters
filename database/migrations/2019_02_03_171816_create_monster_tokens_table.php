<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonsterTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->enum('token_type', ['NUMBER','COLOR','COLORED_NUMBER','MINI']);
            $table->integer('token_number')->nullable()->unsigned();
            $table->string('token_color')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement("ALTER TABLE monster_tokens ADD mini MEDIUMBLOB NULL ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('monster_tokens');
	    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
