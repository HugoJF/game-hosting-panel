<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Deploy;
use Faker\Generator as Faker;

$factory->define(Deploy::class, function (Faker $faker) {
    return [
        'cost_per_period' => 20,
        'cpu'             => 1200,
        'memory'          => 512,
        'disk'            => 5000,
        'io'              => 500,
        'databases'       => 2,
    ];
});
