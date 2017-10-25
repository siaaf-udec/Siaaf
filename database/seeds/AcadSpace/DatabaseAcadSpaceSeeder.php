<?php


use Illuminate\Database\Seeder;

class DatabaseAcadSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAcadspaceSeeder::class);
        $this->call(PermissionAcadspaceSeeder::class);
        $this->call(SoftwareTableSeeder::class);
        $this->call(EspaciosTableSeeder::class);


    }
}