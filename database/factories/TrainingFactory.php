<?php

use Faker\Generator as Faker;

$factory->define(\App\Training::class, function (Faker $faker) {
    return [
        'day'      => $faker->dayOfWeek,
        'capacity' => $faker->numberBetween(10, 50),
        'price'    => $faker->numberBetween(1000, 5000),
        'time'     => $faker->time() . ' - ' . $faker->time(),
    ];
});
