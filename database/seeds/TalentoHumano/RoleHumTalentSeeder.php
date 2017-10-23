<?php

/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 5/10/2017
 * Time: 3:42 PM
 */

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Role;
use App\Container\Users\Src\User;

class RoleHumTalentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Role::class, 1 )->create([
            'name' => 'RRHH',
            'display_name' => 'Funcionario RRHH',
            'description' => 'Acceso completo a la modulo de recursos humanos.',
        ]);

        factory( User::class, 1 )->create([
            'name' => 'Funcionario',
            'lastname' => 'RRHH',
            'state' => 'aprobado',
            'email' => 'RRHH@app.com',
            'password' => bcrypt('root'),
        ]);

        $user = User::where('email', 'RRHH@app.com')->first();
        $role = Role:: where('name' , 'RRHH')->get(['id'])->first();
        $user->roles()->sync($role);

    }

}