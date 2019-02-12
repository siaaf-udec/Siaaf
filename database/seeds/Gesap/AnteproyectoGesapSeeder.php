<?php

use App\Container\Gesap\src\Anteproyecto;
use \Illuminate\Database\Seeder;

class AnteproyectoGesapSeeder extends Seeder
{

    public function run()
    {
        Anteproyecto::insert([
            ['NPRY_Titulo'=>'GESAP version 2',
            'NPRY_Keywords'=>'Plataforma web, investigacion, laravel, PHP, proyectos',
            'NPRY_Descripcion'=>'Plataforma web para la gestion de proyectos y anteproyectos de grado',
            'NPRY_Duracion'=>'6',
            'FK_NPRY_Pre_Director'=>'123400009',
            'FK_NPRY_Estado'=>'4',
            'NPRY_FCH_Radicacion'=>'2019-02-05'],
        ]);
    }
}
