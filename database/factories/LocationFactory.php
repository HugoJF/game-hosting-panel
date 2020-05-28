<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'short' => $faker->city,
        'long'  => $faker->country,
    ];
});
