<?php
use Illuminate\Database\Seeder;

class DatabaseAudiovisualesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       // $this->call(PermissionAudiovisualsSeeder::class);
        $this->call(ProgramasTableAudiovisualsSeeder::class);
        $this->call(EstadosTableAudiovisualsSeeder::class);
        $this->call(PermissionAudiovisualsSeeder::class);
        $this->call(RoleAudiovisualsSeeder::class);
        $this->call(TiposSolicitudTableAudiovisualsSeeder::class);
        $this->call(KitsTableAudiovisualsSeeder::class);
        $this->call(UsersAudiovisualsTableSeeder::class);
        $this->call(TiposArticulosTableAudiovisualsSeeder::class);
        $this->call(ValidationTableAudiovisualsSeeder::class);
        $this->call(ArticulosTableAudiovisualsSeeder::class);
        $this->call(TiposSancionesTableAudiovisualsSeeder::class);
        $this->call(PrestamosTableAudiovisualsSeeder::class);






    }
}