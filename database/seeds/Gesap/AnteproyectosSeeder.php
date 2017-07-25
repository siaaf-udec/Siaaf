<?php

use Illuminate\Database\Seeder;
use App\Container\gesap\src\Anteproyecto;
class AnteproyectosSeeder extends Seeder
{

    public function run()
    {
        factory(Anteproyecto::class, 100)->create();
        
    }
}