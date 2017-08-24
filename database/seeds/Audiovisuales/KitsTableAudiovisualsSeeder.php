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
          [ 'KIT_Nombre' => 'Ninguno' ],
        ];

        foreach ($kits as $kit ) {
            $aux = new Kit;
            $aux->KIT_Nombre = $kit['KIT_Nombre'];
            $aux->save();
        }
    }
}
