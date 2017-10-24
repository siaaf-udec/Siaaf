<?php
/**
 * Copyright (c) 2017 - 2017. Todos los derechos reservados. Ley N° 23 de 1982 Colombia.
 */

/**
 * Created by PhpStorm.
 * User: Daniel Prado
 * Date: 21/07/2017
 * Time: 11:28 AM
 */

use Illuminate\Database\Seeder;

class DatabaseAudiovisualesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(EstadosTableAudiovisualsSeeder::class);
        //$this->call(ProgramasTableAudiovisualsSeeder::class);
        //$this->call(PermissionAudiovisualsSeeder::class);
        $this->call(UsersAudiovisualsTableSeeder::class);
        //$this->call(RoleAudiovisualsSeeder::class);
        //$this->call(KitsTableAudiovisualsSeeder::class);
        //$this->call(TiposArticulosTableAudiovisualsSeeder::class);
        //$this->call(ValidationTableAudiovisualsSeeder::class);
        //$this->call(ArticulosTableAudiovisualsSeeder::class);



    }
}