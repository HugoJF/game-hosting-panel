<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ApiKey;
use Faker\Generator as Faker;

$factory->define(ApiKey::class, function (Faker $faker) {
    return [
        'description' => $faker->words(10),
    ];
});
