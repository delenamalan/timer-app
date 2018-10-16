<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'color' => substr($faker->hexcolor, 1),
    ];
});
