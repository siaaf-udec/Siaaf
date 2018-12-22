<?php

use App\Container\Gesap\src\Actividad;
use \Illuminate\Database\Seeder;

class ActividadesGesapSeeder extends Seeder
{

    public function run()
    {
        Actividad::insert([


            ['CTVD_Nombre'=>'Informe Investigativo', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Marcos (Teorico y Legal)', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Plan de Proyecto', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Requerimientos', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Modelados con Descripciones', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Diseño de Casos de Pruebas(Calisoft)', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Estimacion Recurso', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Resultados', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Conclusiones y recomendaciones', 'CTVD_Descripcion'=>'(Codigo,Programacion)','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Bibliografia', 'CTVD_Descripcion'=>'CALISOFT','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Anexos', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Artículos', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Libro', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Mctr008', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
        ]);
    }
}
