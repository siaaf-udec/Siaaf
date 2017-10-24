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
            ['VAL_PRE_Nombre' => ' ¿Número de préstamos que puede realizar el usuario?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Número de reservas que puede realizar el usuario?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Máximo de horas que pueden reservar un artículo?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Máximo de días que pueden reservar un artículo?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Máximo de horas que pueden reservar un kit? ', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Máximo de días que pueden reservar un kit? ', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Número de artículos que puede Reservar o Prestar por Usuario?	', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Número de horas para cancelar una Reserva?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de horas maximas para articulo con tiempo libre?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de horas maximas para articulo con tiempo asignado?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Días de anticipación para Reservar?	', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Cantidad de Tipos de articulo repetidos que puede reservar el usuario?', 'VAL_PRE_Valor' => '1' ],
            ['VAL_PRE_Nombre' => ' ¿Numero de dias habiles para escoger fecha de reserva?', 'VAL_PRE_Valor' => '1' ],
        ];

        foreach ($preguntas as $pregunta ) {
            $aux = new Validaciones;
            $aux->VAL_PRE_Nombre = $pregunta['VAL_PRE_Nombre'];
            $aux->VAL_PRE_Valor = $pregunta['VAL_PRE_Valor'];
            $aux->save();
        }
    }

}
