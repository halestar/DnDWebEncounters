<?php

use Faker\Generator as Faker;

$factory->define(App\Encounters\Encounter::class, function (Faker $faker) {
    return [
        'user_id' => 100,
	    'name' => $faker->sentence(3),
	    'cr' => $faker->numberBetween(0, 20),
    ];
});
