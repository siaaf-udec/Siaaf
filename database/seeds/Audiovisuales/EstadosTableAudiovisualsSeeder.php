<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\Estado;

class EstadosTableAudiovisualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            [ 'EST_Descripcion' => 'Creado' ],
            [ 'EST_Descripcion' => 'Prestado' ],
            [ 'EST_Descripcion' => 'Reservado' ],
            [ 'EST_Descripcion' => 'Disponible' ],
        ];

        foreach ($estados as $estado ) {
            $aux = new Estado();
            $aux->EST_Descripcion = $estado['EST_Descripcion'];
			$aux->save();
        }
    }
}
