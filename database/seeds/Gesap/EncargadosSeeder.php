<?php

use Illuminate\Database\Seeder;
use App\Container\gesap\src\Encargados;
class EncargadosSeeder extends Seeder
{

    public function run()
    {
        factory(Encargados::class, 100)->create();
        
    }
}