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
            'display_name' => 'Administrador de los proyectos',
            'description' => 'Acceso completo al modulo de prpyectos.',
        ]);

        factory(Role::class, 1)->create([
            'name' => 'USER_CALIDADPCS',
            'display_name' => 'Funcionario de un proyecto',
            'description' => 'Acceso a solo los modulo de sus proyectos.',
        ]);

    }
}
