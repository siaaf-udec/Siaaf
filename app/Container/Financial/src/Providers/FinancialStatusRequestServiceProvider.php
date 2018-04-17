<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialStatusRequestInterface;
use App\Container\Financial\src\Repository\StatusRequestRepository;
use Illuminate\Support\ServiceProvider;

class FinancialStatusRequestServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialStatusRequestInterface::class, function () {
            return new StatusRequestRepository;
        });
    }
}