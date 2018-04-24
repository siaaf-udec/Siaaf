<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialAvailableModulesInterface;
use App\Container\Financial\src\Repository\AvailableModulesRepository;
use Illuminate\Support\ServiceProvider;

class FinancialAvailableModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialAvailableModulesInterface::class, function () {
            return new AvailableModulesRepository;
        });
    }
}