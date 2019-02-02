<?php

use App\Container\Gesap\src\Checklist;
use \Illuminate\Database\Seeder;

class CheckListSeeder extends Seeder
{

    public function run()
    {
        Checklist::insert([


            ['CHK_Checlist'=>'EN CALIFICACIÓN', 'CHK_Checlist_Data'=>'En proceso de calificación la actividad del MCT y/ó proyecto'],
            ['CHK_Checlist'=>'APROVADO', 'CHK_Checlist_Data'=>'Aprovada la actividad'],
            
        ]);
    }
}
