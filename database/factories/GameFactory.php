<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
    	'name' => 'CS:GO ' . $faker->randomNumber(1),
    ];
});
