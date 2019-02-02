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
            ['EST_estado'=>'APROVADO'],
            ['EST_estado'=>'RECHAZADO'],
            ['EST_estado'=>'APLAZADO']
                   
        ]);
    }
}