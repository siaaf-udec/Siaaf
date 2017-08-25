<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Permission;
use App\Container\Permissions\Src\Role;
use App\Container\Users\Src\User;

class DatabaseTalentoHumanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersFinancialTableSeeder::class);
        factory( Role::class, 1 )->create([
            'name' => 'RRHH',
            'display_name' => 'Funcionario RRHH',
            'description' => 'Acceso completo a la modulo de recursos humanos.',
        ]);

        $permission= new Permission;
        $permission->name = 'FUNC_RRHH';
        $permission->display_name = 'HumTalent';
        $permission->description = 'Acceso completo a la modulo de recursos humanos.';
        $permission->module_id = 6;
        $permission ->save();
    }
}