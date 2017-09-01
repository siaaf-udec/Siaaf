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
use App\Container\Acadspace\src\PerimisosAcadSpace;

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

        PerimisosAcadSpace::create([
            'name' => "formAcad", 'display_name' => "FormatosAcademicos", 'description' => "Modulo FormatosAcademicos", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "administ", 'display_name' => "Administrador", 'description' => "Modulo Administrador", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "secret", 'display_name' => "Secretaria", 'description' => "Modulo Secretaria", 'module_id' => "1",

        ]);
        PerimisosAcadSpace::create([
            'name' => "auxapoyo", 'display_name' => "Auxiliar Apoyo", 'description' => "Modulo Rol Auxiliar Apoyo", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "docentes", 'display_name' => "Docentes", 'description' => "Modulo Rol Docentes", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "solicitudes", 'display_name' => "Solicitudes", 'description' => "Modulo Solicitudes", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "horarios", 'display_name' => "Horarios", 'description' => "Modulo Horarios", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "asistencia", 'display_name' => "Asistencia", 'description' => "Modulo Asistencia Docentes", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "reportes", 'display_name' => "Reportes", 'description' => "Modulo Reportes", 'module_id' => "1",

        ]);

        PerimisosAcadSpace::create([
            'name' => "regisHorario", 'display_name' => "Registrar Horario", 'description' => "Registrar Horario", 'module_id' => "1",

        ]);

    }
}