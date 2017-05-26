<?php

namespace App\Container\Users\Src\Facades;

use Illuminate\Support\Facades\Facade;

class UserFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'users';
    }
}
