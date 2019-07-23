<?php

use Illuminate\Database\Seeder;
use App\Container\CalidadPcs\src\Procesos;

class ProcesosCalidadPcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $procesos = [
            [ 'PK_CP_Id_Proceso' => '1','CP_Nombre_Proceso' => 'Desarrollar acta de constitución del proyecto.', 'FK_CP_Id_Etapa' => '1' ],

            [ 'PK_CP_Id_Proceso' => '2','CP_Nombre_Proceso' => 'Desarrollar plan para la dirección del proyecto.', 'FK_CP_Id_Etapa' => '2' ],
            [ 'PK_CP_Id_Proceso' => '3','CP_Nombre_Proceso' => 'Gestión del tiempo del proyecto.', 'FK_CP_Id_Etapa' => '2' ],
            [ 'PK_CP_Id_Proceso' => '4','CP_Nombre_Proceso' => 'Gestión de los Costos del proyecto.', 'FK_CP_Id_Etapa' => '2' ],
            [ 'PK_CP_Id_Proceso' => '5','CP_Nombre_Proceso' => 'Planificar la gestión de la calidad.', 'FK_CP_Id_Etapa' => '2' ],
            [ 'PK_CP_Id_Proceso' => '6','CP_Nombre_Proceso' => 'Planificar la gestión de los recursos humanos.', 'FK_CP_Id_Etapa' => '2' ],
            [ 'PK_CP_Id_Proceso' => '7','CP_Nombre_Proceso' => 'Planificar la gestión de comunicaciones.', 'FK_CP_Id_Etapa' => '2' ],
            [ 'PK_CP_Id_Proceso' => '8','CP_Nombre_Proceso' => 'Gestión de riesgos del proyecto.', 'FK_CP_Id_Etapa' => '2' ],
            [ 'PK_CP_Id_Proceso' => '9','CP_Nombre_Proceso' => 'Planificar la gestión de adquisiciones.', 'FK_CP_Id_Etapa' => '2' ],

            [ 'PK_CP_Id_Proceso' => '10','CP_Nombre_Proceso' => 'Plan para la Dirección del proyecto.', 'FK_CP_Id_Etapa' => '3' ],
            [ 'PK_CP_Id_Proceso' => '11','CP_Nombre_Proceso' => 'Aseguramiento de calidad.', 'FK_CP_Id_Etapa' => '3' ],
            [ 'PK_CP_Id_Proceso' => '12','CP_Nombre_Proceso' => 'Adquirir, desarrollar y dirigir equipo del proyecto.', 'FK_CP_Id_Etapa' => '3' ],
            [ 'PK_CP_Id_Proceso' => '13','CP_Nombre_Proceso' => 'Gestionar las Comunicaciones.', 'FK_CP_Id_Etapa' => '3' ],
            [ 'PK_CP_Id_Proceso' => '14','CP_Nombre_Proceso' => 'Efectuar las adquisiciones.', 'FK_CP_Id_Etapa' => '3' ],
            [ 'PK_CP_Id_Proceso' => '15','CP_Nombre_Proceso' => 'Gestionar la participación de los interesados.', 'FK_CP_Id_Etapa' => '3' ],

            [ 'PK_CP_Id_Proceso' => '16','CP_Nombre_Proceso' => 'Monitorear y controlar el trabajo del proyecto.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '17','CP_Nombre_Proceso' => 'Validar y controlar el alcance.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '18','CP_Nombre_Proceso' => 'Controlar el cronograma.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '19','CP_Nombre_Proceso' => 'Controlar los costos.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '20','CP_Nombre_Proceso' => 'Controlar la calidad.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '21','CP_Nombre_Proceso' => 'Controlar las comunicaciones.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '22','CP_Nombre_Proceso' => 'Controlar los riesgos.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '23','CP_Nombre_Proceso' => 'Controlar las adquisiciones.', 'FK_CP_Id_Etapa' => '4' ],
            [ 'PK_CP_Id_Proceso' => '24','CP_Nombre_Proceso' => 'Controlar la participación de los interesados.', 'FK_CP_Id_Etapa' => '4' ],

            [ 'PK_CP_Id_Proceso' => '25','CP_Nombre_Proceso' => 'Cerrar el proyecto y las adquisiciones.', 'FK_CP_Id_Etapa' => '5' ],
            
        ];

        foreach ($procesos as $proceso ) {
            $aux = new Procesos();
            $aux->PK_CP_Id_Proceso  = $proceso['PK_CP_Id_Proceso'];
            $aux->CP_Nombre_Proceso = $proceso['CP_Nombre_Proceso'];
            $aux->FK_CP_Id_Etapa    = $proceso['FK_CP_Id_Etapa'];
            $aux->save();
        }
    }
}
