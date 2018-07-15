<?php

use App\articulos;
use App\clientes;
use App\impuestos;
use App\imp_art;
use App\empresa;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
/* $factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
}); */

//LLENAMOS ARTÍCULOS
$factory->define(articulos::class, function (Faker\Generator $faker) {

    return [
        'clave'    => $faker->sentence,
        'descripcion' => $faker->sentence,
        'clave_sat' => $faker->word,
        'descripcion_sat' => $faker->word,
        'u_medida_sat' => $faker->word,
        'estado'=> $faker->numberBetween($min = 1,$max = 1),
    ];
});

$factory->define(clientes::class, function (Faker\Generator $faker) {

    return [
        'Nombre'    => $faker->name,
        'RFC' => $faker->sentence,
        'estado' => $faker->numberBetween($min= 0,$max=1),
    ];
});

$factory->define(impuestos::class, function (Faker\Generator $faker) {

    return [
        'Nombre'    => $faker->word,
        'tipo'      => $faker->word,
        'calculo'   => $faker->word,
        'tasa'      => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
        'unidades'  => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
        'tipo_iva'  => $faker->word,
        'estado' => $faker->numberBetween($min= 1,$max=1),
    ];
});

$factory->define(imp_art::class, function (Faker\Generator $faker) {

    $articulos = articulos::all()->random();
    $impuestos = impuestos::all()->random();

    return [
        'id_impuesto'   => $impuestos->id,
        'id_articulo'   => $articulos->id,
    ];
});

$factory->define(empresa::class, function (Faker\Generator $faker) {

    return [
        'Nombre'    => $faker->name,
        'RFC'       => $faker->sentence,
        'regimen'   => $faker->word,
        'estado'=> $faker->numberBetween($min = 0,$max = 1),
    ];
});