<?php

use Illuminate\Database\Seeder;
use App\Container\Permissions\Src\Role;

class RoleAcadspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory( Role::class, 1 )->create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Rol Administrador',
        ]);

        factory( Role::class, 1 )->create([
            'name' => 'auxapoyo',
            'display_name' => 'Auxiliar de Apoyo',
            'description' => 'Rol Auxiliar',
        ]);

        factory( Role::class, 1 )->create([
            'name' => 'docente',
            'display_name' => 'Docente',
            'description' => 'Rol Docente',
        ]);

        factory( Role::class, 1 )->create([
            'name' => 'secretaria',
            'display_name' => 'Secretaria',
            'description' => 'Rol Secretaria',
        ]);

        factory( Role::class, 1 )->create([
            'name' => 'public',
            'display_name' => 'Public',
            'description' => 'Rol Publico',
        ]);
    }
}
