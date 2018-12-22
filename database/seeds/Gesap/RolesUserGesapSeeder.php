<?php

use Illuminate\Database\Seeder;

use App\Container\Gesap\src\RolesUsuario;

class RolesUserGesapSeeder extends Seeder
{
   
    public function run()
    {
        RolesUsuario::insert([
            ['Rol_Usuario'=>'Desarrollador', 'Rol_Descripcion'=>'Es el encargado de desarrollar el proyecto.'],
            ['Rol_Usuario'=>'Jurado', 'Rol_Descripcion'=>'Es el encargado de servir como jurado para un anteproyecto ya radicado, sea aprovado o rechazado.'],
            ['Rol_Usuario'=>'Director', 'Rol_Descripcion'=>'Es el encargado de dirigir la parte de anteproyecto y si es aprovado su posterior desarrollo como proyecto de grado.'],
            
        ]);
    }
}
