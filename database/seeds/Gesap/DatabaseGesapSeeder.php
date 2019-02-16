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
        $this->call(FormatoGesapSeeder::class);
        $this->call(CheckListSeeder::class);
        //$this->call(PermissionGesapSeeder::class);
        $this->call(ActividadesGesapSeeder::class);
        $this->call(EstadoAnteproyectoGesapSeeder::class);
        //$this->call(AnteproyectoGesapSeeder::class);
        $this->call(EstadosGesapSeeder::class);
        //$this->call(CommitGesapSeeder::class);

        $this->call(RolesUserGesapSeeder::class);
 
        $this->call(UsersGesapTableSeeder::class);
       
      
        
    }
}
