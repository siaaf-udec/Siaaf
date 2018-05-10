<?php

namespace App\Container\Financial\src\Middleware;


use App\Container\Financial\src\AvailableModules;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Closure;

class CheckIfAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $module
     * @return mixed
     */
    public function handle($request, Closure $next, $module)
    {
        $available = AvailableModules::where( module_name(), $module )->first();

        if ( isset( $available->{ available_until() } ) ) {
            if ( $available->{ available_until() } >= today() ) {
                return $next($request);
            }
        }

        return AjaxResponse::make(  'Solicitud no disponible',
                                'Este módulo no se encuentra disponible, es probable que la fecha permitida para realizar esta solicitud se haya vencido o no está configurada y no es posible realizar la acción requerida.', '', 403);
    }
}