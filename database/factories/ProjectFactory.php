<?php

use Faker\Generator as Faker;

use App\User;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'color' => substr($faker->hexcolor, 1),
        'user_id' => User::inRandomOrder()->first()->getKey(),
    ];
});
