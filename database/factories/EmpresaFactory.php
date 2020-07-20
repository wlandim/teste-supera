<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Empresa;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'cnpj' => $faker->cnpj,
        'razao_social' => $faker->company,
        'nome_fantasia' => $faker->company,
        'email' => $faker->email,
        'logomarca' => $faker->imageUrl(200, 200, 'business'),
        'status' => $faker->boolean,
    ];
});
