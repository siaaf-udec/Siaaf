<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 2/10/17
 * Time: 2:10 PM
 */

namespace App\Container\Financial\src\Providers;

use App\Container\Financial\src\Interfaces\FinancialCostServiceInterface;
use App\Container\Financial\src\Repository\CostServiceRepository;
use Illuminate\Support\ServiceProvider;

class FinancialCostServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(FinancialCostServiceInterface::class, function () {
            return new CostServiceRepository;
        });
    }
}