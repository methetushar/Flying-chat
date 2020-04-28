<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Message::class, function (Faker $faker) {

    do{
        $from = rand(1,20);
        $to = rand(1,20);
        $is_read = rand(0,1);
    }while($from === $to);
    return [
        'from' => $from,
        'to'  => $to,
        'message' => $faker->sentence,
        'is_read' => $is_read
    ];
});
