<?php

use App\Container\Acadspace\src\Espacios;
use Illuminate\Database\Seeder;

class EspaciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aux = new Espacios();
        $aux->ESP_Nombre_Espacio = 'Ciencias agropecuarias y ambientales';
        $aux->save();

        $aux = new Espacios();
        $aux->ESP_Nombre_Espacio = 'Aulas de computo';
        $aux->save();

        $aux = new Espacios();
        $aux->ESP_Nombre_Espacio = 'Laboratorios Psicologia';
        $aux->save();

    }
}
