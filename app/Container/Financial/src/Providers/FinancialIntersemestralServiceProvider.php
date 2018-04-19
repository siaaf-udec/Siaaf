<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialIntersemestralInterface;
use App\Container\Financial\src\Repository\IntersemestralRepository;
use Illuminate\Support\ServiceProvider;

class FinancialIntersemestralServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialIntersemestralInterface::class, function () {
            return new IntersemestralRepository;
        });
    }
}