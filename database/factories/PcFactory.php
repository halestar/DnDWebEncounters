<?php

use Faker\Generator as Faker;

$factory->define(App\Players\Pc::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
	    'characterClass' => $faker->randomElement(['Barbarian', 'Bard', 'Cleric','Druid','Fighter','Monk','Paladin','Ranger','Rogue','Sorcerer','Warlock','Wizard']),
	    'characterRace' => $faker->randomElement(['Dragonborn','Dwarf','Elf','Gnome','Half-Elf','Halfling','Half-Orc','Human','Tiefling']),
	    'ac' => $faker->numberBetween(10, 20),
	    'hp' => $faker->numberBetween(4, 200),
	    'pp' => $faker->numberBetween(8, 20),
	    'level' => $faker->numberBetween(1, 20),
	    'spellDc' => $faker->numberBetween(0, 20),
    ];
});
