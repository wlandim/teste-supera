<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Obito;
use Faker\Generator as Faker;

$factory->define(Obito::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
    ];
});
