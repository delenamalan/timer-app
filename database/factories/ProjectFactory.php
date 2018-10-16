<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->text(100),
        'color' => substr($faker->hexcolor, 1),
    ];
});
