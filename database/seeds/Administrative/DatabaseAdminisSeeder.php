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
<<<<<<< Updated upstream:database/seeds/Administrative/DatabaseAdminisSeeder.php
        $this->call(PermissionAdminisSeeder::class);
        $this->call(RoleAdminisSeeder::class);
=======
        $tiposSol = [
            [ 'TPSOL_Tipo' => 'Reserva'],
            [ 'TPSOL_Tipo' => 'Prestamo'],
        ];

        foreach ($tiposSol as $tipoSol ) {
            $aux = new TipoSolicitud;
            $aux->TPSOL_Tipo = $tipoSol['TPSOL_Tipo'];



            $aux->save();
        }
>>>>>>> Stashed changes:database/seeds/Audiovisuales/TiposSolicitudTableAudiovisualsSeeder.php
    }
}