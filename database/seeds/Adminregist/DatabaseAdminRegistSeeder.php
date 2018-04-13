<?php


use Illuminate\Database\Seeder;

class DatabaseAdminRegistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NovedadesSeeder::class);
        $this->call(PermissionsAdminRegist::class);
    }
}