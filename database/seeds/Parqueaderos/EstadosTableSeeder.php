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
            [ 'PK_CE_IdEstados'=>'1','CE_Estados' => 'Activo' ],
            [ 'PK_CE_IdEstados'=>'2','CE_Estados' => 'Inactivo' ],          
        ];

        foreach ($estados as $estado ) {
            $aux = new Estados();
            $aux->PK_CE_IdEstados = $estado['PK_CE_IdEstados'];
            $aux->CE_Estados = $estado['CE_Estados'];
            $aux->save();
        }
    }
}
