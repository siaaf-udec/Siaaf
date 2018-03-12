<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\TipoSolicitud;

class TiposSolicitudTableAudiovisualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposSol = [
            [ 'TPSOL_Tipo' => 'Reserva'],
            [ 'TPSOL_Tipo' => 'Prestamo'],


        ];

        foreach ($tiposSol as $tipoSol ) {
            $aux = new TipoSolicitud;
            $aux->TPSOL_Tipo = $tipoSol['TPSOL_Tipo'];



            $aux->save();
        }
    }
}
