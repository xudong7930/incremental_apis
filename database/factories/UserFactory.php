<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'email' => 'sb@qq.com',
        'password' => bcrypt('123')
    ];
});
