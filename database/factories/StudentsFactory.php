<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Student::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'name'    => $faker->name,
        'age'     => rand(1, 20),
        'sex'     => rand(0, 2),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
