<?php

use App\Encounters\CustomMonster;
use App\Encounters\Monster;
use Illuminate\Database\Seeder;

class EncounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$monsters = Monster::allSrMonsters();
	    factory(App\Encounters\Encounter::class, 5)->create()->each(function($encounter) use($monsters)
	    {
	        $sr_monsters = $monsters->random(rand(3, 6));
	        $encounter->srMonsters = $sr_monsters->toArray();
	        $encounter->save();
	        $customMonster = CustomMonster::all()->random(rand(1, 3));
	        foreach($customMonster as $customMonster)
		        $encounter->customMonsters()->attach($customMonster);
	    });
    }
}
