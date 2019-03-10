<?php

use App\Container\Gesap\src\Fechas;
use \Illuminate\Database\Seeder;

class FechasGesapSeeder extends Seeder
{

    public function run()
    {
        Fechas::insert([


            ['FCH_Radicacion'=>'01-01-0001'],
            ['FCH_Radicacion'=>'01-01-0001'],
            ['FCH_Radicacion'=>'01-01-0001'],
            ['FCH_Radicacion'=>'01-01-0001'],
           
         
        ]);
    }
}
