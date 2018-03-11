<?php

namespace App\Container\Users\src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Users\src\Interfaces\UsersUdecInterface;

/*
 * Modelos
 */

use App\Container\Users\src\UsersUdec;

class UsersUdecRepository extends ControllerRepository implements UsersUdecInterface
{
    public function __construct()
    {
        parent::__construct(UsersUdec::class);
    }

    protected function process($model, $data)
    {
        $model['number_document'] = $data['number_document'];
        $model['code'] = (isset($data['code']) || !empty($data['code'])) ? $data['code'] : null;
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