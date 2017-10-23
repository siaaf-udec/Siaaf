<?php

use Illuminate\Database\Seeder;
use App\Container\Carpark\src\Estados;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            [ 'CE_Estados' => 'Activo' ],
            [ 'CE_Estados' => 'Inactivo' ],          
        ];

        foreach ($estados as $estado ) {
            $aux = new Estados();
            $aux->CE_Estados = $estado['CE_Estados'];
            $aux->save();
        }
    }
}
