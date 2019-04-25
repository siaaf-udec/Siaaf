<?php

use Illuminate\Database\Seeder;
use App\Container\CalidadPcs\src\Etapas;

class EtapasCalidadPcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $etapas = [
            [ 'PK_CE_Id_Etapa' => '1','CE_Etapa' => 'Etapa de inicio' ],
            [ 'PK_CE_Id_Etapa' => '2','CE_Etapa' => 'Etapa de planificacion' ],
            [ 'PK_CE_Id_Etapa' => '3','CE_Etapa' => 'Etapa de ejecucion' ],
            [ 'PK_CE_Id_Etapa' => '4','CE_Etapa' => 'Etapa de monitoreo y control' ],
            [ 'PK_CE_Id_Etapa' => '5','CE_Etapa' => 'Etapa de cierre' ],
            //[ 'PK_CD_IdDependencia' => '5','CD_Dependencia' => 'Ingeniería Agronómica' ],
        ];

        foreach ($etapas as $etapa ) {
            $aux = new Etapas();
            $aux->PK_CE_Id_Etapa = $etapa['PK_CE_Id_Etapa'];
            $aux->CE_Etapa      = $etapa['CE_Etapa'];
            $aux->save();
        }
    }
}