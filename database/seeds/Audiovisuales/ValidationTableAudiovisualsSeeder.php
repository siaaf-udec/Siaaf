<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Audiovisuals\src\Validaciones;

class ValidationTableAudiovisualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preguntas = [
            ['VAL_PRE_Nombre' => ' ¿Numero de Prestamos y Reservas que puede realizar el Usuario?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Maximo de horas que pueden reservar un articulo?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de kits que puede Reservar o Prestar por Usuario?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de articulos que puede Reservar o Prestar por Usuario?	', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de dias que puede Reservar?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de horas para cancelar un Prestamo?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Dias de anticipación para Reservar?	', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Cantidad de Tipos de articulo repetidos que puede reservar el usuario?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de horas maximas para articulo con tiempo libre?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de horas maximas para articulo con tiempo asignado?', 'VAL_PRE_Valor' => '1' ],
        ];

        foreach ($preguntas as $pregunta ) {
            $aux = new Validaciones;
            $aux->VAL_PRE_Nombre = $pregunta['VAL_PRE_Nombre'];
            $aux->VAL_PRE_Valor = $pregunta['VAL_PRE_Valor'];
            $aux->save();
        }
    }

}
