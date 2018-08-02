<?php

use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'x' => $faker->numberBetween(0, 100),
        'y' => $faker->numberBetween(0, 100),
    ];
});
