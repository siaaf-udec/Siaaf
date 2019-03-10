<?php

use Illuminate\Database\Seeder;
use App\Container\Permissions\Src\Role;

class RoleCalidadPcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 1)->create([
            'name' => 'ADMIN_CALIDADPCS',
            'display_name' => 'Administrador del parqueadero',
            'description' => 'Acceso completo a la modulo de parqueaderos.',
        ]);

        factory(Role::class, 1)->create([
            'name' => 'USER_CALIDADPCS',
            'display_name' => 'Funcionario del parqueadero',
            'description' => 'Acceso parcial a la modulo de parqueaderos.',
        ]);

    }
}
