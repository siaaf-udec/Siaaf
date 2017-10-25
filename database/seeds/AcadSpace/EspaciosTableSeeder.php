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
        factory( Espacios::class, 1 )->create([
            'ESP_Nombre_Espacio' => 'Ciencias agropecuarias y ambientales',
        ]);
        factory( Espacios::class, 2 )->create([
            'ESP_Nombre_Espacio' => 'Aulas de computo',
        ]);
        factory( Espacios::class, 3 )->create([
            'ESP_Nombre_Espacio' => 'Laboratorios Psicologia',
        ]);
    }
}
