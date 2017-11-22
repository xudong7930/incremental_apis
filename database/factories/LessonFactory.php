<?php

use Faker\Generator as Faker;
use App\Lesson;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'content' => $faker->paragraph(4),
        'some_bool' => $faker->boolean(),
    ];
});
