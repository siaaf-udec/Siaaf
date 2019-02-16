<?php

use App\Container\Gesap\src\Formato;
use \Illuminate\Database\Seeder;

class FormatoGesapSeeder extends Seeder
{

    public function run()
    {
        Formato::insert([


            ['PK_Id_Formato'=>'1', 'MCT_Formato'=>'Mct'],
            ['PK_Id_Formato'=>'2', 'MCT_Formato'=>'Requerimiento'],
         
        ]);
    }
}
