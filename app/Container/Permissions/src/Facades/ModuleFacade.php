<?php

namespace App\Container\Permissions\Src\Facades;

use Illuminate\Support\Facades\Facade;

class ModuleFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'modules';
    }
}
