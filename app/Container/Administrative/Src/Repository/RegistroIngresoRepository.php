<?php

namespace App\Container\Administrative\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Administrative\Src\Interfaces\RegistroIngresoInterface;

/*
 * Modelos
 */
use App\Container\Administrative\Src\RegistroIngreso;

class RegistroIngresoRepository extends ControllerRepository implements RegistroIngresoInterface
{
    public function __construct()
    {
        parent::__construct(RegistroIngreso::class);
    }

    protected function process($registro, $data)
    {
        $registro['id_registro'] = $data['id_registro'];
        $registro['id_proceso'] = $data['id_proceso'];
        $registro->save();
        return $registro;
    }
}