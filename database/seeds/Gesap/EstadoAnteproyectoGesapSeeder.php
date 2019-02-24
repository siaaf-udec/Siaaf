<?php

use Illuminate\Database\Seeder;

use App\Container\Gesap\src\EstadoAnteproyecto;

class EstadoAnteproyectoGesapSeeder extends Seeder
{
   
    public function run()
    {
        EstadoAnteproyecto::insert([
            ['EST_estado'=>'EN ESPERA'],
            ['EST_estado'=>'ASIGNADO'],            
            ['EST_estado'=>'RADICADO'],
            ['EST_estado'=>'APROBADO'],
            ['EST_estado'=>'REPROBADO'],
            ['EST_estado'=>'APLAZADO']
                   
        ]);
    }
}