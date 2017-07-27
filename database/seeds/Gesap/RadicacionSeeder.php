<?php

use Illuminate\Database\Seeder;
use App\Container\gesap\src\Radicacion;
class RadicacionSeeder extends Seeder
{

    public function run()
    {
        factory(Radicacion::class, 100)->create();
        
    }
}