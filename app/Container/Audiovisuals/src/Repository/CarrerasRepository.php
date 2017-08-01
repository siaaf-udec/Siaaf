<?php

namespace App\Container\Audiovisuals\Src\Repository;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\Carreras;
/*
 * Interfaces
 */
use App\Container\Audiovisuals\Src\Interfaces\CarrerasInterface;
use App\Container\Overall\Src\Repository\ControllerRepository;

class CarrerasRepository extends ControllerRepository implements CarrerasInterface
{
    public function __construct()
    {
        parent::__construct(Carreras::class);
    }

    protected function process($carreras, $data)
    {
        $carreras['id']     = $data['id'];
        $carreras['Nombre'] = $data['Nombre'];

        $carreras->save();
        return $carreras;
    }
}
