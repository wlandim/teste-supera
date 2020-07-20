<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unidade;
use Faker\Generator as Faker;

$factory->define(Unidade::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'municipio' => $faker->city,
        'logomarca' => $faker->imageUrl(200, 200, 'business'),
        'tipo' => $faker->numberBetween(0, 3),
        'status' => $faker->boolean,
    ];
});
