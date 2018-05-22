<?php

namespace App\Container\Permissions\Src\Facades;

use Illuminate\Support\Facades\Facade;

class AuditFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'audits';
    }
}
