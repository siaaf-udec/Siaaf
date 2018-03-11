<?php

namespace App\Container\Users\src\Providers;

use Illuminate\Support\ServiceProvider;
use App\Container\Users\src\Repository\UsersUdecRepository;

class UsersUdecServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Container\Users\src\Interfaces\UsersUdecInterface', function($app)
        {
            return new UsersUdecRepository;
        });
    }
}