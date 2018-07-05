<?php

use Illuminate\Database\Seeder;
use App\Container\Carpark\src\Dependencias;

class DependenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $dependencias = [
            [ 'PK_CD_IdDependencia' => '1','CD_Dependencia' => 'Administrativo' ],
            [ 'PK_CD_IdDependencia' => '2','CD_Dependencia' => 'Profesor(a)' ],
            [ 'PK_CD_IdDependencia' => '3','CD_Dependencia' => 'Estudiante' ],
            //[ 'PK_CD_IdDependencia' => '4','CD_Dependencia' => 'Ingeniería Ambiental' ],
            //[ 'PK_CD_IdDependencia' => '5','CD_Dependencia' => 'Ingeniería Agronómica' ],
        ];

        foreach ($dependencias as $dependencia ) {
            $aux = new Dependencias();
            $aux->PK_CD_IdDependencia = $dependencia['PK_CD_IdDependencia'];
            $aux->CD_Dependencia      = $dependencia['CD_Dependencia'];
            $aux->save();
        }
    }
}
