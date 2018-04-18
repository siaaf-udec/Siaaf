<?php

namespace App\Container\Audiovisuals\Src\Facades;

use Illuminate\Support\Facades\Facade;

class CarrerasFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Carreras';
    }
}
