<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Game;
use App\Node;
use App\Server;
use App\User;
use Faker\Generator as Faker;

$factory->define(Server::class, function (Faker $faker) {
	return [
		'name'    => $faker->name . ' Server',
	];
});
