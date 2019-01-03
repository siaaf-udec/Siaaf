<?php

use Illuminate\Database\Seeder;
use App\Container\Gesap\src\Estados;

class EstadosGesapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estados::insert([
            [ 'PK_IdEstado'=>'1','STD_Descripcion' => 'Activo'],
            [ 'PK_IdEstado'=>'2','STD_Descripcion' => 'Inactivo'],          
        ]);
    }
}
