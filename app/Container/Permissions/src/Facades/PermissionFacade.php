<?php

namespace App\Container\Permissions\Src\Facades;

use Illuminate\Support\Facades\Facade;

class PermissionsFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Permissions';
    }
}
