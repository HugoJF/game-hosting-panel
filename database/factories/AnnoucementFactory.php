<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'type'        => 'success',
        'description' => $faker->sentence,
        'action'      => $faker->word,
        'action_url'  => $faker->url,
        'expires_at'  => $faker->dateTimeBetween(now()->subYear(), now()->addYear()),
    ];
});

$factory->state(Announcement::class, 'expired', function (Faker $faker) {
    return [
        'expires_at' => $faker->dateTimeBetween(now()->subYear(), now()->subDay()),
    ];
});

$factory->state(Announcement::class, 'valid', function (Faker $faker) {
    return [
        'expires_at' => $faker->dateTimeBetween(now()->addDay(), now()->addYear()),
    ];
});

$factory->state(Announcement::class, 'visible', function (Faker $faker) {
    return [
        'visible' => true,
    ];
});

$factory->state(Announcement::class, 'hidden', function (Faker $faker) {
    return [
        'visible' => false,
    ];
});
