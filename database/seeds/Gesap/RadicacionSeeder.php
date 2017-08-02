<?php

use Illuminate\Database\Seeder;
use App\Container\gesap\src\Radicacion;
class RadicacionSeeder extends Seeder
{

    public function run()
    {
         Radicacion::insert([
        ['RDCN_Min'=> 'MINr008_V5 john fredy Y hector castellanos.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>1],
['RDCN_Min'=> 'MINr008_V5 Efrain Vergara-Fredy Rodriguez.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>2],
['RDCN_Min'=> 'MINr008_V5.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>3],
['RDCN_Min'=> 'MINr008_V5 - Oscar Gomez - Cristian Rodriguez.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>4],
['RDCN_Min'=> 'MINr008_V5.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>5],
['RDCN_Min'=> 'MIN Daniel Prado Laura Sanchez.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>6],
['RDCN_Min'=> 'MINr008_V5.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>7],
['RDCN_Min'=> 'proyecto-administrador-de-modulos-del-CIT-1-1.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>8],
['RDCN_Min'=> 'MINr008_V5 (1).pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>9],
['RDCN_Min'=> 'MINr008_V5-vr7.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>10],
['RDCN_Min'=> 'MINr008_V5.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>11],
['RDCN_Min'=> 'MINr008_V5_Landscape.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>12],
['RDCN_Min'=> 'MINr008_V5-AUDIOVISUALES_FINAL.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>13],
['RDCN_Min'=> 'MINr008_V5-proyecto-futbol-Revisado (1).pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>14],
['RDCN_Min'=> 'MINr008_V5.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>15],
['RDCN_Min'=> 'MINr008_V5-carranza_camacho.pdf','RDCN_Requerimientos'=> 'Requerimientos.pdf','FK_TBL_Anteproyecto_id'=>16]
       ]);
             }
}