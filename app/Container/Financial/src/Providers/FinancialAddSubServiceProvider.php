<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialAddSubInterface;
use App\Container\Financial\src\Repository\AddSubRepository;
use Illuminate\Support\ServiceProvider;

class FinancialAddSubServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialAddSubInterface::class, function () {
            return new AddSubRepository;
        });
    }
}