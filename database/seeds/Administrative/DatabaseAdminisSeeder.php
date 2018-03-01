<?php


use Illuminate\Database\Seeder;

class DatabaseAdminisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionAdminisSeeder::class);
        $this->call(RoleAdminisSeeder::class);
    }
}