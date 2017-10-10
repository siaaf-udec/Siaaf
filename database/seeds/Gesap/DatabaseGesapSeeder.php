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
<<<<<<< Updated upstream
        $this->call(AnteproyectosSeeder::class);
        $this->call(RadicacionSeeder::class);
        $this->call(EncargadosSeeder::class);
        $this->call(PermissionGesapSeeder::class);
=======
        //$this->call(AnteproyectosSeeder::class);
      //  $this->call(RadicacionSeeder::class);
      //  $this->call(EncargadosSeeder::class);
      //  $this->call(RoleGesapSeeder::class);
     //   $this->call(PermissionGesapSeeder::class);
>>>>>>> Stashed changes
    }
}