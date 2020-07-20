<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Usuario;
use Faker\Generator as Faker;

$factory->define(Usuario::class, function (Faker $faker) {
    return [
        'cpf' => $faker->cpf,
        'nome' => $faker->name,
        'usuario' => $faker->userName,
    ];
});
