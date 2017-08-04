<?php

namespace App\Container\Audiovisuals\Src\Providers;

use App\Container\Audiovisuals\Src\Repository\CarrerasRepository;
use Illuminate\Support\ServiceProvider;

class CarrerasServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Container\Audiovisuals\Src\Interfaces\CarrerasInterface', function ($app) {
            return new CarrerasRepository;
        });
    }
}
