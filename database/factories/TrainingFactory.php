<?php

use Faker\Generator as Faker;

$factory->define(\App\Training::class, function (Faker $faker) {
    return [
        'address'  => $faker->address,
        'day'      => $faker->dayOfWeek,
        'season'   => "{$faker->monthName} {$faker->year} - {$faker->monthName} {$faker->year}",
        'trainer'  => $faker->name,
        'capacity' => $faker->numberBetween(10, 50),
        'price'    => $faker->numberBetween(1000, 5000),
        'time'     => $faker->time() . ' - ' . $faker->time(),
        'date'     => $faker->date(),
        'hidden'   => $faker->numberBetween(1, 10) > 8,
        'advanced' => $faker->numberBetween(0, 1),
    ];
});
