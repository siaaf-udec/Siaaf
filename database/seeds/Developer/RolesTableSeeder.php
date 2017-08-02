<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Permissions\Src\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Role::class, 1 )->create([
            'name' => 'master',
            'display_name' => 'Administrador Master',
            'description' => 'Acceso completo a la plataforma.',
        ]);
    }
}
