<?php

namespace App\Container\Permissions\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Permissions\Src\Interfaces\PermissionInterface;

/*
 * Modelos
 */
use App\Container\Permissions\Src\Permission;

class PermissionRepository extends ControllerRepository implements PermissionInterface
{
    public function __construct()
    {
        parent::__construct(Permission::class);
    }

    protected function process($permission, $data)
    {
        $permission['name'] = $data['name'];
        $permission['display_name'] = $data['display_name'];
        $permission['description'] = $data['description'];
        $permission['module_id'] = $data['module_id'];
        $permission->save();
        return $permission;
    }
}