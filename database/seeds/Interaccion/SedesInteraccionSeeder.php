<?php

use App\Container\Users\Src\User;
use App\Container\Unvinteraction\src\TipoPregunta;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use Illuminate\Database\Seeder;


class SedesInteraccionSeeder extends Seeder
{

    public function run()
    {
        Sede::insert([
            ['PK_SEDE_Sede'=> 1,
             'SEDE_Sede' => 'Fusagasuga'
            ],
            ['PK_SEDE_Sede'=> 2,
             'SEDE_Sede' => 'Facatativa',
            ],
            ['PK_SEDE_Sede'=> 3,
             'SEDE_Sede' => 'Soacha'
            ],
            ['PK_SEDE_Sede'=> 4,
             'SEDE_Sede' => 'Chia',
            ],
            ['PK_SEDE_Sede'=> 5,
             'SEDE_Sede' => 'Choconta'
            ],
            ['PK_SEDE_Sede'=> 6,
             'SEDE_Sede' => 'Otro',
            ],
        ]);
    }
}
