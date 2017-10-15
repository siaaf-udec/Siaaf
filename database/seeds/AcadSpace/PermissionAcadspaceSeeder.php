<?php

use App\Container\Permissions\Src\Permission;
use Illuminate\Database\Seeder;

class PermissionAcadspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission= new Permission;
        $permission->name = 'formAcad';
        $permission->display_name = 'FormatosAcademicos';
        $permission->description = 'Modulo FormatosAcademicos.';
        $permission->module_id = 1;
        $permission ->save();

        $permission2= new Permission;
        $permission2->name = 'administ';
        $permission2->display_name = 'Administrador';
        $permission2->description = 'Modulo Administrador.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission3= new Permission;
        $permission3->name = 'secret';
        $permission3->display_name = 'Secretaria';
        $permission3->description = 'Modulo Secretaria.';
        $permission3->module_id = 1;
        $permission3 ->save();

        $permission4= new Permission;
        $permission4->name = 'auxapoyo';
        $permission4->display_name = 'Auxiliar Apoyo';
        $permission4->description = 'Modulo Rol Auxiliar Apoyo.';
        $permission4->module_id = 1;
        $permission4 ->save();

        $permission5= new Permission;
        $permission5->name = 'docentes';
        $permission5->display_name = 'Docentes';
        $permission5->description = 'Modulo Rol Docentes.';
        $permission5->module_id = 1;
        $permission5 ->save();

        $permission6 = new Permission;
        $permission6->name = 'solicitudes';
        $permission6->display_name = 'Solicitudes';
        $permission6->description = 'Modulo Solicitudes.';
        $permission6->module_id = 1;
        $permission6 ->save();

        $permission7 = new Permission;
        $permission7->name = 'horarios';
        $permission7->display_name = 'Horarios';
        $permission7->description = 'Modulo Horarios.';
        $permission7->module_id = 1;
        $permission7 ->save();

        $permission8 = new Permission;
        $permission8->name = 'asistencia';
        $permission8->display_name = 'Asistencia';
        $permission8->description = 'Modulo Asistencia Docentes.';
        $permission8->module_id = 1;
        $permission8 ->save();

        $permission9 = new Permission;
        $permission9->name = 'reportes';
        $permission9->display_name = 'Reportes';
        $permission9->description = 'Modulo Reportes.';
        $permission9->module_id = 1;
        $permission9->save();

        $permission10 = new Permission;
        $permission10->name = 'regisHorario';
        $permission10->display_name = 'Registrar Horario';
        $permission10->description = 'Registrar Horario.';
        $permission10->module_id = 1;
        $permission10->save();

        $permission10 = new Permission;
        $permission10->name = 'public';
        $permission10->display_name = 'Publico';
        $permission10->description = 'Registrar asistencia.';
        $permission10->module_id = 1;
        $permission10->save();

    }
}
