<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Acompanhante;
use Faker\Generator as Faker;

$factory->define(Acompanhante::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
    ];
});
