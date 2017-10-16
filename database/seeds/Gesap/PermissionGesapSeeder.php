<?php

use App\Container\Permissions\Src\Permission;
use \Illuminate\Database\Seeder;

class PermissionGesapSeeder extends Seeder
{

    public function run()
    {
        Permission::insert([
            ['name'=>'Create_User_Gesap','display_name'=>'Crear Usuarios','description'=>'Permite la creacion de nuevos usuarios de la plataforma','module_id'=>'7'],
            ['name'=>'Assing_permission_Gesap','display_name'=>'Asignar Permisos','description'=>'Asigna los permisos a los usuarios existentes','module_id'=>'7'],
            
            ['name'=>'Create_Project_Gesap','display_name'=>'Crear Anteproyecto','description'=>'Creacion de nuevos anteproyectos y sus documentos','module_id'=>'7'],
            ['name'=>'Assign_teacher_Gesap','display_name'=>'Asignar Docentes','description'=>'Asignacion de directores y jurados a los anteproyectos existentes','module_id'=>'7'],
            ['name'=>'Modify_Project_Gesap','display_name'=>'Modificar Anteproyectos','description'=>'Modificar o actualizar los datos de un anteproyecto previo','module_id'=>'7'],
            ['name'=>'See_All_Project_Gesap','display_name'=>'Ver todos los Anteproyectos','description'=>'Listar todos los proyectos creados en la plataforma','module_id'=>'7'],
            ['name'=>'Report_Gesap','display_name'=>'Ver Reportes','description'=>'Ver los reportes','module_id'=>'7'],
            
            ['name'=>'Jury_List_Gesap','display_name'=>'Proyectos de Jurado','description'=>'Listar los proyectos asignados al usuario como jurado','module_id'=>'7'],
            ['name'=>'Director_List_Gesap','display_name'=>'Proyectos de Director','description'=>'Listar los proyectos asignados al usuario como director','module_id'=>'7'],
            
            ['name'=>'See_Observations_Gesap','display_name'=>'Ver Observaciones','description'=>'Ver las observaciones realizadas al proyecto en especifico','module_id'=>'7'],
            ['name'=>'Update_Final_Project_Gesap','display_name'=>'Subir Archivos de Proyecto','description'=>'Subida de archivos para el proyecto final','module_id'=>'7']
        ]);
        
    }
}