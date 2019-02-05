<?php

use Illuminate\Database\Seeder;

class PlayerAndPcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Players\Player::class, 5)->create()
	        ->each(function($player)
	        {
	            $player->pcs()->saveMany(factory(App\Players\Pc::class, 3)->make());
	        });
    }
}
