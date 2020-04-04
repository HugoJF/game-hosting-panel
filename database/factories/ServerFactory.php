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
		'game_id' => Game::query()->inRandomOrder()->first(),
		'node_id' => Node::query()->inRandomOrder()->first(),
		'user_id' => User::query()->inRandomOrder()->first(),
	];
});
