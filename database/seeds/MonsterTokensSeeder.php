<?php

use Illuminate\Database\Seeder;

class MonsterTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$colors =
		    [
		        '#ff0000' => 'Red',
			    '#00ff00' => 'Green',
			    '#A608F5' => 'Purple',
		    ];
        foreach($colors as $hex => $color)
        {
        	for($i = 1; $i <= 6; $i++)
	        {
		        DB::table('monster_tokens')->insert([
			        'user_id' => 100,
			        'name' => $color . " " . $i,
			        'token_type' => 'COLORED_NUMBER',
			        'token_number' => $i,
			        'token_color' => $hex,
		        ]);
	        }
        }
    }
}
