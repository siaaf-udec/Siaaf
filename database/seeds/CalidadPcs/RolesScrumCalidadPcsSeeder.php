<?php

use Illuminate\Database\Seeder;
use App\Container\CalidadPcs\src\Rol_Scrum;

class RolesScrumCalidadPcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $roles = [
            [ 'PK_CR_Id_Rol_Scrum' => '1','CR_Nombre_Rol_Scrum' => 'Scrum Master' ],
            [ 'PK_CR_Id_Rol_Scrum' => '2','CR_Nombre_Rol_Scrum' => 'Product Owner' ],
            [ 'PK_CR_Id_Rol_Scrum' => '3','CR_Nombre_Rol_Scrum' => 'Stakeholder' ],
            [ 'PK_CR_Id_Rol_Scrum' => '4','CR_Nombre_Rol_Scrum' => 'Lider Equipo Scrum' ],
            [ 'PK_CR_Id_Rol_Scrum' => '5','CR_Nombre_Rol_Scrum' => 'Integrante Equipo Scrum' ],
        ];

        foreach ($roles as $rol ) {
            $aux = new Rol_Scrum();
            $aux->PK_CR_Id_Rol_Scrum = $rol['PK_CR_Id_Rol_Scrum'];
            $aux->CR_Nombre_Rol_Scrum = $rol['CR_Nombre_Rol_Scrum'];
            $aux->save();
        }
    }
}