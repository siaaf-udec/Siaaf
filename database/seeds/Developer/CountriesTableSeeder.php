<?php

use Illuminate\Database\Seeder;

/*
 * Modelos
 */
use App\Container\Users\Src\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
          [ 'name' => 'No Seleccionado', 'code' => 'ND' ],
        ];

        foreach ($countries as $country ) {
            $aux = new Country;
            $aux->name = $country['name'];
            $aux->code = $country['code'];
            $aux->save();
        }
    }
}
