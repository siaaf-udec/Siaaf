<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialUserInterface;
use App\Container\Financial\src\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class FinancialUserServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialUserInterface::class, function()
        {
            return new UserRepository;
        });
    }
}