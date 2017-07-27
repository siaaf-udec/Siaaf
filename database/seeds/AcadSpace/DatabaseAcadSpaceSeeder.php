<?php
/**
 * Copyright (c) 2017. Todos los derechos reservados. Ley N° 23 de 1982 Colombia.
 */

/**
 * Created by PhpStorm.
 * User: Daniel Prado
 * Date: 21/07/2017
 * Time: 11:28 AM
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Container\Acadspace\src\Roles;
use App\Container\Acadspace\src\Modulos;

class DatabaseAcadSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersFinancialTableSeeder::class);
        Roles::create([
            'name' => 'admin', 'display_name' => 'Administrador', 'description' => 'Rol Administrador',
        ]);

        Roles::create([
            'name' => "auxapoyo", 'display_name' => "Auxiliar de Apoyo", 'description' => "Rol Auxiliar",
        ]);

        Roles::create([
            'name' => "docente", 'display_name' => "Docente", 'description' => "Rol Docente",
        ]);

        Roles::create([
            'name' => "secretaria", 'display_name' => "Secretaria", 'description' => "Rol Secretaria",
        ]);

        Modulos::create([
            'name'   => 'formAcad',  'description'   => 'Formatos Academicos'

        ]);
    }
}