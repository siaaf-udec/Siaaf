<?php

namespace App\Container\Users\Src\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

/*
* Rules
*/

use App\Container\Users\Src\Rules\CurrentPassword;

class ValidatorServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->validator->extendImplicit('current_password', function ($attribute, $value, $parameters, $validator) {
            //return new CurrentPassword;
            return Hash::check($value, Auth::user()->getAuthPassword());
        }, trans('validation.current_password'));
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}