<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialExtensionInterface;
use App\Container\Financial\src\Repository\ExtensionRepository;
use Illuminate\Support\ServiceProvider;

class FinancialExtensionServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialExtensionInterface::class, function () {
            return new ExtensionRepository;
        });
    }
}