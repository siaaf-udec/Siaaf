<?php

use App\Container\Unvinteraction\src\Estado;
use Illuminate\Database\Seeder;


class EstadosInteraccionSeeder extends Seeder
{

    public function run()
    {
        Estado::insert([
             ['PK_ETAD_Estado'=> 1,
             'ETAD_Estado' => 'Activo'
            ],
            ['PK_ETAD_Estado'=> 2,
             'ETAD_Estado' => 'Inactivo',
            ],
        ]);
    }
}
