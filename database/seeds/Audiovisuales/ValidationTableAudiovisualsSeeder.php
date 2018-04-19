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
            ['VAL_PRE_Nombre' => ' ¿Número de horas máximas para tipo articulo con tiempo libre?', 'VAL_PRE_Valor' => '3' ],
            ['VAL_PRE_Nombre' => ' ¿Número de horas máximas para tipo articulo con tiempo asignado?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Número de horas máximas para kit con tiempo libre?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Número de horas máximas para kit con tiempo asignado?', 'VAL_PRE_Valor' => '3' ],
            ['VAL_PRE_Nombre' => ' ¿Número de préstamos que puede realizar el usuario? ', 'VAL_PRE_Valor' => '4' ],
            ['VAL_PRE_Nombre' => ' ¿Número de reservas que puede realizar el usuario? ', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Cantidad de artículos que puede solicitar en préstamo el usuario? (cuenta el número de artículos que contenga el Kit ejemplo Kit -> 3 artículos y un artículo aparte = 4 artículos)	', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Cantidad de Tipos de articulo repetidos que puede solicitar el usuario?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Cantidad de artículos que puede solicitar en reserva el usuario? (cuenta el número de artículos que contenga el Kit ejemplo Kit -> 3 artículos y un artículo aparte = 4 artículos)', 'VAL_PRE_Valor' => '4' ],
            ['VAL_PRE_Nombre' => ' ¿Número de horas para cancelar una reserva?', 'VAL_PRE_Valor' => '2' ],
            ['VAL_PRE_Nombre' => ' ¿Número de horas de anticipación para Reservar? ', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Número de horas hábiles para escoger fecha de reserva?', 'VAL_PRE_Valor' => '1' ],
        ];
        foreach ($preguntas as $pregunta ) {
            $aux = new Validaciones;
            $aux->VAL_PRE_Nombre = $pregunta['VAL_PRE_Nombre'];
            $aux->VAL_PRE_Valor = $pregunta['VAL_PRE_Valor'];
            $aux->save();
        }
    }
}
