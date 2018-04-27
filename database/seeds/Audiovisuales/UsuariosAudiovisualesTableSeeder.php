<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 26/04/2018
 * Time: 1:09 PM
 */
use App\Container\Audiovisuals\src\UsuarioAudiovisuales;
use \Illuminate\Database\Seeder;

class UsuariosAudiovisualesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposSol = [
            ['USER_FK_User' => 1, 'USER_FK_Programa' => 1],
            ['USER_FK_User' => 2, 'USER_FK_Programa' => 2],
            ['USER_FK_User' => 3, 'USER_FK_Programa' => 3],
        ];

        foreach ($tiposSol as $tipoSol) {
            $aux = new UsuarioAudiovisuales;
            $aux->USER_FK_User = $tipoSol['USER_FK_User'];
            $aux->USER_FK_Programa = $tipoSol['USER_FK_Programa'];
            $aux->save();
        }
    }
}