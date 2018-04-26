<?php


use App\Container\Unvinteraction\src\TipoPregunta;

use Illuminate\Database\Seeder;


class TipoPreguntaInteraccionSeeder extends Seeder
{

    public function run()
    {
        
        TipoPregunta::insert([
            ['PK_TPPG_Tipo_Pregunta'=> 1,
             'TPPG_Tipo' => 'Coordinador-Pasante'
            ],
            ['PK_TPPG_Tipo_Pregunta'=> 2,
             'TPPG_Tipo' => 'Empresa-Pasante',
            ],
            ['PK_TPPG_Tipo_Pregunta'=> 3,
             'TPPG_Tipo' => 'Coordinador-Empresa',
            ],
            ['PK_TPPG_Tipo_Pregunta'=> 4,
             'TPPG_Tipo' => 'Pasante-Empresa',
            ]
        ]);
        
        
    }
}
