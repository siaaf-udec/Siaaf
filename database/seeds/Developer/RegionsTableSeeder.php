<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Users\Src\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [ 'name' => 'No Seleccionado', 'code' => 'ND', 'country_id' => '1' ],
        ];

        foreach ($regions as $region ) {
            $aux = new Region;
            $aux->name = $region['name'];
            $aux->code = $region['code'];
            $aux->country_id = $region['country_id'];
            $aux->save();
        }
    }
}
