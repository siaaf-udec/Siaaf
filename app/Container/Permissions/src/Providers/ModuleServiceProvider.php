<?php

namespace App\Container\Permissions\Src\Providers;

use Illuminate\Support\ServiceProvider;
use App\Container\Permissions\Src\Repository\ModuleRepository;

class ModuleServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Container\Permissions\Src\Interfaces\ModuleInterface', function($app)
        {
            return new ModuleRepository;
        });
    }
}