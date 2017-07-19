<?php

use Illuminate\Database\Seeder;
use App\Container\Audiovisuals\Src\Administrador;
class AdmonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Administrador::class, 100)->create();
        
    }
}