<?php

namespace App\Container\Permissions\Src\Providers;

use Illuminate\Support\ServiceProvider;
use App\Container\Permissions\Src\Repository\RoleRepository;

class RoleServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Container\Permissions\Src\Interfaces\RoleInterface', function($app)
        {
            return new RoleRepository;
        });
    }
}