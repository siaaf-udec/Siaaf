<?php


use Illuminate\Database\Seeder;

class DatabaseAdminRegistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< Updated upstream:database/seeds/Adminregist/DatabaseAdminRegistSeeder.php
        $this->call(NovedadesSeeder::class);
        $this->call(PermissionsAdminRegist::class);
=======
        $kits = [

            ['KIT_Nombre' => 'Ninguno'],
            ['KIT_Nombre' => 'Kit 1'],
            ['KIT_Nombre' => 'Kit 2'],
            ['KIT_Nombre' => 'Kit 3'],

        ];

        foreach ($kits as $kit) {
            $aux = new Kit();
            $aux->KIT_Nombre = $kit['KIT_Nombre'];
            $aux->KIT_FK_Estado_id = 1;
            $aux->KIT_FK_Tiempo = 3;
            $aux->KIT_Codigo = 1234;
            $aux->save();
        }
>>>>>>> Stashed changes:database/seeds/Audiovisuales/KitsTableAudiovisualsSeeder.php
    }
}