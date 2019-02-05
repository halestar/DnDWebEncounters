<?php

use Faker\Generator as Faker;

$factory->define(App\Encounters\CustomMonster::class, function (Faker $faker) {
    return [
        'user_id' => 100,
	    'name' => $faker->word,
	    'cr' => $faker->numberBetween(0, 19),
	    'monsterType' => 'Humanoid',
	    'monsterSize' => 'Medium',
	    'alignment' => $faker->randomElement(['LG','LN','LE','NG','N','NE','CG','CN','CE']),
	    'str' => $faker->numberBetween(0, 20),
	    'dex' => $faker->numberBetween(0, 20),
	    'con' => $faker->numberBetween(0, 20),
	    'wis' => $faker->numberBetween(0, 20),
	    'int' => $faker->numberBetween(0, 20),
	    'cha' => $faker->numberBetween(0, 20),
	    'hp' => $faker->numberBetween(4, 200),
	    'ac' => $faker->numberBetween(10, 20),
	    'speed' => '30 ft',
	    'hd' => '5d6',
    ];
});
