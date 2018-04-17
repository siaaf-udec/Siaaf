<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 5/02/18
 * Time: 8:49 PM
 */

namespace App\Container\Financial\src\Providers;


use App\Container\Financial\src\Interfaces\FinancialFileTypeInterface;
use App\Container\Financial\src\Repository\FileTypeRepository;
use Illuminate\Support\ServiceProvider;

class FinancialFileTypeServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialFileTypeInterface::class, function () {
            return new FileTypeRepository;
        });
    }
}