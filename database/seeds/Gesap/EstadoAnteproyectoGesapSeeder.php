<?php

use Illuminate\Database\Seeder;

use App\Container\Gesap\src\EstadoAnteproyecto;

class EstadoAnteproyectoGesapSeeder extends Seeder
{
   
    public function run()
    {
        EstadoAnteproyecto::insert([
            ['EST_Estado'=>'EN ESPERA'],
            ['EST_Estado'=>'ASIGNADO'],            
            ['EST_Estado'=>'RADICADO'],
            ['EST_Estado'=>'APROBADO'],
            ['EST_Estado'=>'REPROBADO'],
            ['EST_Estado'=>'APLAZADO'],
            ['EST_Estado'=>'CANCELADO']
                   
        ]);
    }
}