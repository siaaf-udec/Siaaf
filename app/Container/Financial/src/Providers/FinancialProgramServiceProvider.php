<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialProgramInterface;
use App\Container\Financial\src\Repository\ProgramRepository;
use Illuminate\Support\ServiceProvider;

class FinancialProgramServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialProgramInterface::class, function()
        {
            return new ProgramRepository;
        });
    }
}