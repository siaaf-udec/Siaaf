<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialCheckInterface;
use App\Container\Financial\src\Repository\CheckRepository;
use Illuminate\Support\ServiceProvider;

class FinancialCheckServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialCheckInterface::class, function () {
            return new CheckRepository;
        });
    }
}