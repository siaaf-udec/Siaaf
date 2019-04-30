<?php

use Illuminate\Database\Seeder;
use App\Container\CalidadPcs\src\Estados;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            [ 'PK_CE_Id_Estados'=>'1','CE_Estados' => 'Activo' ],
            [ 'PK_CE_Id_Estados'=>'2','CE_Estados' => 'Inactivo' ],          
        ];

        foreach ($estados as $estado ) {
            $aux = new Estados();
            $aux->PK_CE_Id_Estado = $estado['PK_CE_Id_Estados'];
            $aux->CE_Estado = $estado['CE_Estados'];
            $aux->save();
        }
    }
}
