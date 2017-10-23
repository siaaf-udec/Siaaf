<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */




class DatabaseTalentoHumanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleHumTalentSeeder::class);
        $this->call(PermissionHumTalentSeeder::class);

    }
}