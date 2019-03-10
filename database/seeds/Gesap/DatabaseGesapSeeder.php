<?php

use Illuminate\Database\Seeder;

class DatabaseGesapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleGesapSeeder::class);
        $this->call(UsersGesapTableSeeder::class);
        $this->call(PermissionGesapSeeder::class);
        $this->call(ActividadesGesapSeeder::class);

    }
}
