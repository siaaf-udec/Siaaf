<?php

use App\Container\Gesap\src\Mctr008;
use \Illuminate\Database\Seeder;

class ActividadesGesapSeeder extends Seeder
{

    public function run()
    {
        Mctr008::insert([


            ['MCT_Actividad'=>'Titulo Del Proyecto', 'MCT_Descripcion'=>'aaaa'],
            ['MCT_Actividad'=>'Impacto', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Trayectoria', 'MCT_Descripcion'=>'aa'],
            ['MCT_Actividad'=>'ResEjecutivo', 'MCT_Descripcion'=>'aa'],
            ['MCT_Actividad'=>'Planteamiento del problema', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Objetivo General', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Objetivos Especificos', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Metodologia', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Bibliografia', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Cronograma', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Detalles de personas', 'MCT_Descripcion'=>'aaa'],
            ['MCT_Actividad'=>'Financiacion', 'MCT_Descripcion'=>'aa'],
            ['MCT_Actividad'=>'Rubros', 'MCT_Descripcion'=>'aa'],
     //       ['MCT_Actividad'=>'Libro', 'CTVD_Descripcion'=>''],
            ['MCT_Actividad'=>'Resultados', 'MCT_Descripcion'=>'aa'],
        ]);
    }
}
