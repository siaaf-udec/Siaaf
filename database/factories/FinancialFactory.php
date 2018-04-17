<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Container\Financial\src\Constants\ConstantRoles;
use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Program;
use App\Container\Financial\src\Subject;
use App\Container\Financial\src\SubjectProgram;
use App\Container\Permissions\Src\Role;
use App\Container\Users\Src\User;

$factory->define(Subject::class, function (Faker\Generator $faker) {
    return [
        SchemaConstant::SUBJECT_CODE    => $faker->unique()->numerify('##########'),
        SchemaConstant::SUBJECT_NAME    => $faker->word,
        SchemaConstant::SUBJECT_CREDITS => $faker->numberBetween(1, 3),
    ];
});

$factory->define(Program::class, function (Faker\Generator $faker) {
    static $programs = [
        'Administración de Empresas',
        'Contaduría Pública',
        'Ingeniería de Sistemas',
        'Ingeniería Agronómica',
        'Ingeniería Ambiental',
        'Psicología',
    ];
    return [
        SchemaConstant::PROGRAM_NAME    => $faker->unique()->randomElement($programs),
    ];
});

$factory->define(SubjectProgram::class, function (Faker\Generator $faker) {

    $users = User::select('id')->whereHas('roles', function ($query) {
        $query->where('role_id', Role::select('id')
              ->where('name', ConstantRoles::FINANCIAL_TEACHER_ROLE )
              ->get()->first()->id);
    })->get()->pluck('id')->toArray();

    $programs = Program::select( SchemaConstant::PRIMARY_KEY )->get()
                ->pluck( SchemaConstant::PRIMARY_KEY )->toArray();

    $subjects = Subject::select( SchemaConstant::PRIMARY_KEY )->get()
                        ->pluck( SchemaConstant::PRIMARY_KEY )->toArray();

    return [
        SchemaConstant::SUBJECT_FOREIGN_KEY => $faker->unique()->randomElement($subjects),
        SchemaConstant::PROGRAM_FOREIGN_KEY => $faker->randomElement($programs),
        SchemaConstant::TEACHER_FOREIGN_KEY => $faker->randomElement($users),
    ];
});