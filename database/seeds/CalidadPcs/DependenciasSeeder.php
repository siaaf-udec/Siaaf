<?php

use Illuminate\Database\Seeder;
use App\Container\CalidadPcs\src\Dependencias;

class DependenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $dependencias = [
            [ 'PK_CD_Id_Dependencia' => '1','CD_Dependencia' => 'Estudiante' ],
            [ 'PK_CD_Id_Dependencia' => '2','CD_Dependencia' => 'Docente' ],
            [ 'PK_CD_Id_Dependencia' => '3','CD_Dependencia' => 'Externo' ],
            [ 'PK_CD_Id_Dependencia' => '4','CD_Dependencia' => 'Admin' ],
            //[ 'PK_CD_IdDependencia' => '5','CD_Dependencia' => 'Ingeniería Agronómica' ],
        ];

        foreach ($dependencias as $dependencia ) {
            $aux = new Dependencias();
            $aux->PK_CD_Id_Dependencia = $dependencia['PK_CD_Id_Dependencia'];
            $aux->CD_Dependencia      = $dependencia['CD_Dependencia'];
            $aux->save();
        }
    }
}
