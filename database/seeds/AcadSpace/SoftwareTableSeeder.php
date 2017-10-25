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
        factory( Software::class, 1 )->create([
            'SOF_Nombre_Soft' => 'NInguno',
            'SOF_Version' => '0',
            'SOF_Licencias' => '0',
        ]);
    }
}
