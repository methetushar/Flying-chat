<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Register::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->freeEmail,
        'avatar' => 'assets/img/avatar.png',
        'is_active' => rand(0,1),
        'password' => 'password'
    ];
});
