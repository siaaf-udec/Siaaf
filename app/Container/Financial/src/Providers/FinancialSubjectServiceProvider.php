<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialSubjectInterface;
use App\Container\Financial\src\Repository\SubjectRepository;
use Illuminate\Support\ServiceProvider;

class FinancialSubjectServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialSubjectInterface::class, function()
        {
            return new SubjectRepository;
        });
    }
}