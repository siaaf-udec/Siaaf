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
        $this->call(EstadosGesapSeeder::class); //*Requerido para servir*
        $this->call(EstadoAnteproyectoGesapSeeder::class); //*Requerido para servir*
        $this->call(RolesUserGesapSeeder::class); //*Requerido para servir*
        $this->call(RoleGesapSeeder::class); //*Requerido para servir*
        $this->call(FechasGesapSeeder::class); //*Requerido para servir*
        $this->call(FormatoGesapSeeder::class);//*Requerido para servir*
        $this->call(CheckListSeeder::class);//*Requerido para servir*
        $this->call(PermissionGesapSeeder::class);//permisos Developer
        $this->call(ActividadesGesapSeeder::class);//*Requerido para servir*
    }
}
