<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'description' => $faker->sentence(6),
    ];
});

$factory->state(Task::class, 'empty', [
    'name' => '',
    'description' => '',
]);

$factory->state(Task::class, 'short', function (Faker $faker) {
    return [
        'name' => $faker->randomLetter,
        'description' => $faker->randomLetter,
    ];
});

$factory->state(Task::class, 'long', function (Faker $faker) {
    return [
        'name' => $faker->sentence(75, false),
        'description' => $faker->sentence(75, false),
    ];
});
