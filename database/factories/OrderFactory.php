<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'email'  => $faker->email,
        'phone'  => $faker->phoneNumber,
        'name'   => $faker->name,
        'parent' => $faker->name,
        'price'  => $faker->numberBetween(1000, 5000),
        'count'  => $faker->numberBetween(1, 3),
        'state'  => $faker->numberBetween(0, 2),
        'text'   => $faker->text(),
    ];
});
