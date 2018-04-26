<?php

use App\Container\Unvinteraction\src\Sede;

use Illuminate\Database\Seeder;


class SedesInteraccionSeeder extends Seeder
{

    public function run()
    {
        Sede::insert([
            ['PK_SEDE_Sede'=> 1,
             'SEDE_Sede' => 'Fusagasugá'
            ],
            ['PK_SEDE_Sede'=> 2,
             'SEDE_Sede' => 'Facatativá',
            ],
            ['PK_SEDE_Sede'=> 3,
             'SEDE_Sede' => 'Soacha'
            ],
            ['PK_SEDE_Sede'=> 4,
             'SEDE_Sede' => 'Chía',
            ],
            ['PK_SEDE_Sede'=> 5,
             'SEDE_Sede' => 'Chocontá'
            ],
            ['PK_SEDE_Sede'=> 6,
             'SEDE_Sede' => 'Otro',
            ],
        ]);
    }
}
