<?php

namespace App\Container\Users\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Users\Src\Interfaces\UserInterface;

/*
 * Modelos
 */
use App\Container\Users\Src\User;

class UserRepository extends ControllerRepository implements UserInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    protected function process($module, $data)
    {
        $module['name'] = $data['name'];
        $module->save();
        return $module;
    }
}