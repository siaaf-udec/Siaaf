<?php

use App\Container\Acadspace\src\Software;
use Illuminate\Database\Seeder;

class SoftwareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aux = new Software;
        $aux->SOF_Nombre_Soft = 'Ninguno';
        $aux->SOF_Version = 0;
        $aux->SOF_Licencias = 0;
        $aux->save();
    }
}
