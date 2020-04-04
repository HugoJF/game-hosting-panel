<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Transaction;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
    	'value' => $faker->numberBetween(-1000, 10000),
		'user_id' => User::query()->inRandomOrder()->first(),
    ];
});
