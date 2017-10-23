<?php

/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 23/10/2017
 * Time: 8:53 AM
 */
use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Role;
use App\Container\Users\Src\User;
use App\Container\Permissions\Src\Permission;

class UserHumTalentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        $permiso = Permission::where('name', 'FUNC_RRHH')->first();
        $permiso->roles()->sync($role);

    }

}