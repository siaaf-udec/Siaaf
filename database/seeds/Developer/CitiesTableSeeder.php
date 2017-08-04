<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Users\Src\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [ 'region_id' => 1,  'country_id' => 1, 'latitude' => 0, 'longitude' => 0, 'name' => 'No Seleccionado' ],
        ];

        foreach ($countries as $country ) {
            $aux = new City;
            $aux->region_id = $country['region_id'];
            $aux->country_id = $country['country_id'];
            $aux->latitude = $country['latitude'];
            $aux->longitude = $country['longitude'];
            $aux->name = $country['name'];
            $aux->save();
        }
    }
}
