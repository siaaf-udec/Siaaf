<?php

use Illuminate\Database\Seeder;

use App\Container\Permissions\Src\Interfaces\ModuleInterface;

/*
 * Modelos
 */
use App\Container\Permissions\Src\Module;

class ModulesTableSeeder extends Seeder
{
    protected $moduleRepository;

    public function __construct(ModuleInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
          [ 'name' => 'Espacios Académicos', 'description' => 'Esp-Acad' ],
          [ 'name' => 'Audiovisuales', 'description' => 'Aud-Visu' ],
          [ 'name' => 'Parqueadero', 'description' => 'Parqueaderos' ],
          [ 'name' => 'Financiero', 'description' => 'Financiero' ],
          [ 'name' => 'Interacción Universitaria', 'description' => 'Int-Univ' ],
          [ 'name' => 'Talento Humano', 'description' => 'Talent-Huma' ],
          [ 'name' => 'Gesap', 'description' => 'Gesap' ],
            [ 'name' => 'Master', 'description' => 'Modulo Administrador' ],
            [ 'name' => 'Administrativo', 'description' => 'Modulo Administrativo' ],
            [ 'name' => 'Usuarios Udec', 'description' => 'Modulo Usuarios Udec' ],
            [ 'name' => 'Admisiones y Registro', 'description' => 'Modulo de Admisiones y Registro' ]
        ];

        foreach ($modules as $module ) {
            $this->moduleRepository->store($module);
        }
    }
}
