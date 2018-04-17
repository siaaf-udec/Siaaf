<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialIntersemestralStudentInterface;
use App\Container\Financial\src\Repository\IntersemestralStudentRepository;
use Illuminate\Support\ServiceProvider;

class FinancialIntersemestralStudentServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialIntersemestralStudentInterface::class, function () {
            return new IntersemestralStudentRepository;
        });
    }
}