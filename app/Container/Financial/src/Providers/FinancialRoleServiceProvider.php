<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialRoleInterface;
use App\Container\Permissions\Src\Repository\RoleRepository;
use Illuminate\Support\ServiceProvider;

class FinancialRoleServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialRoleInterface::class, function()
        {
            return new RoleRepository;
        });
    }
}