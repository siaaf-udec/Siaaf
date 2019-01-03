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
            ['Rol_Usuario'=>'Estudiante', 'Rol_Descripcion'=>'Es la persona vista como estudiante quien realizaara el proceso de radicacion de un anteproycto.'],
            ['Rol_Usuario'=>'Profesor', 'Rol_Descripcion'=>'Es quien orienta a los estudiantes en su idea de anteproyecto y proecto de grado.'],
            ['Rol_Usuario'=>'Administrador', 'Rol_Descripcion'=>'Es el encargado de la plataforma GESAP.'],            
        ]);
    }
}
