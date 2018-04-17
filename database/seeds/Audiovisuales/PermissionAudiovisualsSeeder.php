<?php

use App\Container\Permissions\Src\Permission;
use \Illuminate\Database\Seeder;

class PermissionAudiovisualsSeeder extends Seeder
{

    public function run()
    {
        $permisos = [
            ['name'=>'SUPER_ADMIN_AUDIOVISUALES','display_name'=>'Super Administrador de Audiovisuales','description'=>'Acceso de super administrador a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'ADMIN_AUDIOVISUALES','display_name'=>'Administrador de Audiovisuales','description'=>'Acceso de administrador a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'FUNC_AUDIOVISUALES','display_name'=>'Funcionario de Audiovisuales','description'=>'Acceso de funcionario a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_MODULE','display_name'=>'Funcionario de Audiovisuales','description'=>'Acceso de funcionario a el modulo de audiovisuales.','module_id'=>'2']

        ];

        foreach ($permisos as $permiso ) {
            $aux = new Permission;
            $aux->name = $permiso['name'];
            $aux->display_name = $permiso['display_name'];
            $aux->description = $permiso['description'];
            $aux->module_id = $permiso['module_id']; //2

            $aux->save();
        }
    }
}