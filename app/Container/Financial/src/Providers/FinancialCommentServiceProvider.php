<?php

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialCommentInterface;
use App\Container\Financial\src\Repository\CommentRepository;
use Illuminate\Support\ServiceProvider;

class FinancialCommentServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialCommentInterface::class, function () {
            return new CommentRepository;
        });
    }
}