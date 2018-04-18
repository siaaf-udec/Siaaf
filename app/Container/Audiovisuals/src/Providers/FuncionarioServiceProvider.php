<?php

namespace App\Container\Audiovisuals\Src\Providers;

use App\Container\Audiovisuals\Src\Repository\FuncionarioRepository;
use Illuminate\Support\ServiceProvider;

class FuncionarioServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Container\Audiovisuals\Src\Interfaces\FuncionarioInterface', function ($app) {
            return new FuncionarioRepository;
        });
    }
}
