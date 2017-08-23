<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\TipoArticulo;

class TiposArticulosTableAudiovisualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [ 'TPART_Nombre' => 'Computador' ],
            [ 'TPART_Nombre' => 'Control' ],
            [ 'TPART_Nombre' => 'Cable' ],
            [ 'TPART_Nombre' => 'VideoBeam' ],
            [ 'TPART_Nombre' => 'Cabina' ],

        ];

        foreach ($tipos as $tipo ) {
            $aux = new TipoArticulo;
            $aux->TPART_Nombre = $tipo['TPART_Nombre'];


            $aux->save();
        }
    }
}
