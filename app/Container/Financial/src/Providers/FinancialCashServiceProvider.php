<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialCashInterface;
use App\Container\Financial\src\Repository\CashRepository;
use Illuminate\Support\ServiceProvider;

class FinancialCashServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialCashInterface::class, function () {
            return new CashRepository;
        });
    }
}