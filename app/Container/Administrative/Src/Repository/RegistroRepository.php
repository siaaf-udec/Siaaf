<?php

namespace App\Container\Administrative\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Administrative\Src\Interfaces\RegistroInterface;

/*
 * Modelos
 */

use App\Container\Administrative\Src\Registro;

class RegistroRepository extends ControllerRepository implements RegistroInterface
{
    public function __construct()
    {
        parent::__construct(Registro::class);
    }

    protected function process($model, $data)
    {
        $model['number_document'] = $data['number_document'];
        $model['username'] = $data['username'];
        $model['lastname'] = $data['lastname'];
        $model['type_user'] = $data['type_user'];
        $model['company'] = (isset($data['company']) || !empty($data['company'])) ? $data['company'] : null;
        $model['place'] = $data['place'];
        $model['number_phone'] = $data['number_phone'];
        $model['email'] = $data['email'];
        $model->save();
        return $model;
    }
}