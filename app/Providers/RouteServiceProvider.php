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
    protected $financialNamespace = 'App\Container\Financial\src\Controllers';

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

        $this->mapGesapRoutes();

        $this->mapCalisoftRoutes();

        $this->mapHumtalentRoutes();

        $this->mapSportcitRoutes();

        $this->mapAdministrative();

        $this->mapAdminRegistRoutes();

        $this->mapCrmUdecRoutes();

        $this->mapAutoevaluationRoutes();

        $this->mapCalidadPcsRoutes();


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
        Route::prefix('espacios-academicos')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/acadspace.php'));
    }

    protected function mapAudioVisualsRoutes()
    {
        Route::prefix('audiovisuales')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/audiovisuals.php'));
    }

    protected function mapCarParkRoutes()
    {
        Route::prefix('parqueadero')
            ->middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/carpark.php'));
    }

    protected function mapFinancialRoutes()
    {
        Route::prefix('financiero')
            ->middleware(['web', 'auth'])
            ->namespace($this->financialNamespace)
            ->group(base_path('routes/financial.php'));
    }

    protected function mapUnvInteractionRoutes()
    {
        Route::prefix('interaccion-universitaria')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/unvinteraction.php'));
    }

    protected function mapGesapRoutes()
    {
        Route::prefix('gesap')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/gesap.php'));
    }

    protected function mapCalisoftRoutes()
    {
        Route::prefix('calisoft')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/calisoft.php'));
    }

    protected function mapHumtalentRoutes()
    {
        Route::prefix('talento-humano')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/humtalent.php'));
    }

    protected function mapSportcitRoutes()
    {
        Route::prefix('sportcit')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/sportcit.php'));
    }

    protected function mapAdministrative()
    {
        Route::prefix('administrative')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/administrative.php'));
    }

    protected function mapAdminRegistRoutes()
    {
        Route::prefix('adminregist')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/adminregist.php'));
    }

    protected function mapCrmUdecRoutes()
    {
        Route::prefix('crmudec')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/crmudec.php'));
    }

    protected function mapAutoevaluationRoutes()
    {
        Route::prefix('autoevaluation')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/autoevaluation.php'));
    }

    protected function mapCalidadPcsRoutes()
    {
        Route::prefix('calidadpcs')
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/calidadpcs.php'));
    }
}
