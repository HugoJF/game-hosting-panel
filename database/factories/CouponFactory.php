<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code'     => $faker->word,
        'max_uses' => $faker->numberBetween(5, 10),
        'value'    => $faker->numberBetween(50, 1500),
    ];
});
