<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Helpers\StringFormatter;
use Illuminate\Support\ServiceProvider;

class StringHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('strfin', function () {
            return new StringFormatter;
        });
    }
}
