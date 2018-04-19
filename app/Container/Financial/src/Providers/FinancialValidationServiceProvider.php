<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialValidationInterface;
use App\Container\Financial\src\Repository\ValidationRepository;
use Illuminate\Support\ServiceProvider;

class FinancialValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialValidationInterface::class, function () {
            return new ValidationRepository;
        });
    }
}