<?php

use Faker\Generator as Faker;

$factory->define(App\Players\Player::class, function (Faker $faker) {
    return [
    	'user_id' => 100,
        'name' => $faker->name,
	    'dci' => $faker->randomNumber(6),
    ];
});
