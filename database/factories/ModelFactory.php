<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|pero que era ajjaja

*/
use App\Container\Users\Src\User;
use App\Container\Permissions\Src\Role;
use App\Container\Audiovisuals\Src\Administrador;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'display_name' => $faker->name,
        'description' => $faker->text,
    ];
});

//agrega datos DB audiovisuales
$factory->define(Administrador::class, function (Faker\Generator $faker) {
    return [
        'PK_FNS_Cedula' => $faker->unique()->ean8,//8 numeros aleatorios y unicos
        'FNS_Clave' =>  '12345',
        'FK_FNS_Rol' => 'Administrador',
        'FNS_Nombres' =>  $faker->name,
        'FNS_Apellidos' =>  $faker->lastName,
        'FNS_Direccion' =>  $faker->secondaryAddress,
        'FNS_Correo' =>  $faker->unique()->freeEmail,
        'FNS_Telefono' =>  $faker->phoneNumber,
        'FK_FNS_Estado' =>  $faker->name,
    ];
});



