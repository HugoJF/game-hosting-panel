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

$factory->state(Transaction::class, 'credit', function (Faker $faker) {
    return [
        'value' => $faker->numberBetween(0, 10000),
    ];
});

$factory->state(Transaction::class, 'debit', function (Faker $faker) {
    return [
        'value' => $faker->numberBetween(-10000, 0),
    ];
});
