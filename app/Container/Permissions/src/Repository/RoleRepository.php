<?php

namespace App\Container\Permissions\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Permissions\Src\Interfaces\RoleInterface;

/*
 * Modelos
 */
use App\Container\Permissions\Src\Role;

class RoleRepository extends ControllerRepository implements RoleInterface
{
    public function __construct()
    {
        parent::__construct(Role::class);
    }

    protected function process($role, $data)
    {
        $role['name'] = $data['name'];
        $role['display_name'] = $data['display_name'];
        $role['description'] = $data['description'];
        $role->save();
        return $role;
    }
}