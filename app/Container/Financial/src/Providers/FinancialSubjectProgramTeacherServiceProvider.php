<?php

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialSubjectProgramTeacherInterface;
use App\Container\Financial\src\Repository\SubjectProgramTeacherRepository;
use Illuminate\Support\ServiceProvider;

class FinancialSubjectProgramTeacherServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind( FinancialSubjectProgramTeacherInterface::class, function () {
            return new SubjectProgramTeacherRepository;
        });
    }
}