<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Project;
use App\User;

$factory->define(App\Entry::class, function (Faker $faker) {
    $start = Carbon::now()->addMinutes(mt_rand(1500,2500));
    $end = Carbon::parse($start->toDateTimeString())->addMinutes(mt_rand(5,500));
    $user =  User::inRandomOrder()->first();
    $project = Project::inRandomOrder()->first();

    return [
        'title' => $faker->bs,
        'project_id' => $project->getKey(),
        'user_id' => $project->user->getKey(),
        'start' => $start,
        'end' => $end,
    ];
});
