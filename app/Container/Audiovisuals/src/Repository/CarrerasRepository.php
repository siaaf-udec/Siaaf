<?php

namespace App\Container\Audiovisuals\Src\Repository;

/*
 * Modelos
 */
/*
 * Interfaces
 */
use App\Container\Audiovisuals\Src\Interfaces\CarrerasInterface;
use App\Container\Audiovisuals\src\Programas;
use App\Container\Overall\Src\Repository\ControllerRepository;

class CarrerasRepository extends ControllerRepository implements CarrerasInterface
{
    public function __construct()
    {
        parent::__construct(Programas::class);
    }

    protected function process($carreras, $data)
    {
        $carreras['id']     = $data['id'];
        $carreras['PRO_Nombre'] = $data['PRO_Nombre'];

        $carreras->save();
        return $carreras;
    }
}
