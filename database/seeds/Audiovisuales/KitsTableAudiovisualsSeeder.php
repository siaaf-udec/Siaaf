<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */

use App\Container\Audiovisuals\Src\Kit;

class KitsTableAudiovisualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kits = [

            ['KIT_Nombre' => 'Ninguno'],
            ['KIT_Nombre' => 'Kit 1'],
            ['KIT_Nombre' => 'Kit 2'],
            ['KIT_Nombre' => 'Kit 3'],

        ];

        foreach ($kits as $kit) {
            $aux = new Kit();
            $aux->KIT_Nombre = $kit['KIT_Nombre'];
            $aux->KIT_FK_Estado_id = 1;
            $aux->save();
        }
    }
}
