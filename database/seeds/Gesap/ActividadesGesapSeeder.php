<?php

use App\Container\Gesap\Src\Actividad;
use \Illuminate\Database\Seeder;

class ActividadesGesapSeeder extends Seeder
{

    public function run()
    {
        Actividad::insert([
            ['CTVD_Nombre'=>'Carta de Aval del director de proyecto', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Marco Teórico', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Marco Legal', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Diagrama MER ', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Diagramas de clases ', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Diagramas de casos de uso ', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Diagrama de secuencia ', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Diagrama de actividades ', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Desarrollo', 'CTVD_Descripcion'=>'(Codigo,Programacion)','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Registro  de Pruebas', 'CTVD_Descripcion'=>'CALISOFT','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Artículo de propuesta', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Artículo de proyecto', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Manual Técnico', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Manual de Usuario', 'CTVD_Descripcion'=>'','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Libro', 'CTVD_Descripcion'=>'Min 80 hojas','CTVD_Default'=>'1'],
            ['CTVD_Nombre'=>'Repositorio DICTUM ', 'CTVD_Descripcion'=>'Formato AAAr113_V1','CTVD_Default'=>'1'],
        ]);
    }
}
