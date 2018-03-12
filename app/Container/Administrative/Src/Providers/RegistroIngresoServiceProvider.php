<?php

namespace App\Container\Administrative\Src\Providers;

use Illuminate\Support\ServiceProvider;
use App\Container\Administrative\Src\Repository\RegistroIngresoRepository;

class RegistroIngresoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Container\Administrative\Src\Interfaces\RegistroIngresoInterface', function($app)
        {
            return new RegistroIngresoRepository;
        });
    }
}