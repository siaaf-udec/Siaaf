<?php

namespace App\Container\Users\Src\Providers;

use Illuminate\Support\ServiceProvider;
use App\Container\Users\Src\Repository\UserRepository;

class UserServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Container\Users\Src\Interfaces\UserInterface', function($app)
        {
            return new UserRepository;
        });
    }
}