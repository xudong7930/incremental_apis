<?php

use App\Lesson;
use App\LessonTag;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(LessonTag::class, function (Faker $faker) {
    $lessonIds = Lesson::pluck('id')->toArray();
    $tagIds = Tag::pluck('id')->toArray();
    return [
        'lesson_id' => $faker->randomElement($lessonIds),
        'tag_id' => $faker->randomElement($tagIds)
    ];

});
