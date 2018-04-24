<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 19/04/2018
 * Time: 10:22 PM
 */

use \Illuminate\Database\Seeder;
use App\Container\Audiovisuals\Src\TipoSancion;
class TiposSancionesTableAudiovisualsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [

            ['TIPO_Nombre' => 'Sancion por entrega','TIPO_Descripcion' => 'Sancnion por no entregar los articulos a la fecha correspondiente'],
            ['TIPO_Nombre' => 'Sancion por perdida','TIPO_Descripcion' => 'Sancnion por perdida de los elementos solicitados'],
            ['TIPO_Nombre' => 'Sancion por daño','TIPO_Descripcion' => 'Sancnion por daño de los elementos solicitados'],
            ['TIPO_Nombre' => 'Sancion por reserva','TIPO_Descripcion' => 'Sancnion por realizar la solicitud y no cumplir con recibirlo'],

        ];

        foreach ($tipos as $tipo) {
            $aux = new TipoSancion();
            $aux->TIPO_Nombre = $tipo['TIPO_Nombre'];
            $aux->TIPO_Descripcion = $tipo['TIPO_Descripcion'];
            $aux->save();
        }
    }
}