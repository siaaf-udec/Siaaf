<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAcadSpaceRoutes();

        $this->mapAudioVisualsRoutes();

        $this->mapCarParkRoutes();

        $this->mapFinancialRoutes();

        $this->mapUnvInteractionRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapAcadSpaceRoutes()
    {
        Route::prefix('acadspace')
            ->middleware(['web','auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/acadspace.php'));
    }

    protected function mapAudioVisualsRoutes()
    {
        Route::prefix('audiovisuals')
            ->middleware(['web','auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/audiovisuals.php'));
    }

    protected function mapCarParkRoutes()
    {
        Route::prefix('carpark')
            ->middleware(['web','auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/carpark.php'));
    }

    protected function mapFinancialRoutes()
    {
        Route::prefix('financial')
            ->middleware(['web','auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/financial.php'));
    }

    protected function mapUnvInteractionRoutes()
    {
        Route::prefix('unvinteraction')
            ->middleware(['web','auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/unvinteraction.php'));
    }
}
