<?php

use Illuminate\Database\Seeder;

class CustomMonsterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\Encounters\CustomMonster::class, 10)->create();
    }
}
