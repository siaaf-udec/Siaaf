<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialFileInterface;
use App\Container\Financial\src\Repository\FileRepository;
use Illuminate\Support\ServiceProvider;

class FinancialFileServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialFileInterface::class, function () {
            return new FileRepository;
        });
    }
}