<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Game;
use App\Node;
use App\Server;
use App\User;
use Faker\Generator as Faker;

$factory->define(Server::class, function (Faker $faker) {
    return [
        'name'           => $faker->name . ' Server',
        'hash'           => $faker->word,
        'ip'             => $faker->ipv4,
        'billing_period' => $faker->randomElement(['hourly', 'daily', 'monthly']),
        'cpu' => $faker->numberBetween(0, 2400),
        'memory' => $faker->numberBetween(0, 2000),
        'disk' => $faker->numberBetween(0, 30000),
        'io' => 500,
        'databases' => $faker->numberBetween(0, 3),
    ];
});
