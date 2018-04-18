<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\Programas;

class ProgramasTableAudiovisualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programas = [
            [ 'PRO_Nombre' => 'Ingenieria de Sistemas' ],
            [ 'PRO_Nombre' => 'Ingenieria Ambiental' ],
            [ 'PRO_Nombre' => 'Psicologia' ],
            [ 'PRO_Nombre' => 'Contaduria' ],
            [ 'PRO_Nombre' => 'Ingenieria Agronomica' ],
            [ 'PRO_Nombre' => 'Administracion de Empresas' ],
            [ 'PRO_Nombre' => 'Otro' ],
        ];

        foreach ($programas as $programa ) {
            $aux = new Programas();
            $aux->PRO_Nombre = $programa['PRO_Nombre'];
            $aux->save();
        }
    }
}
