<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Location;
use App\Node;
use Faker\Generator as Faker;

$factory->define(Node::class, function (Faker $faker) {
    return [
        'name'        => 'Host' . $faker->word,
        'description' => $faker->sentence,
        'location_id' => $faker->numberBetween(0, 100),
    ];
});
