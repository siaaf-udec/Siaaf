<?php

namespace App\Container\Financial\src\Middleware;


use App\Container\Financial\src\AvailableModules;
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

        return abort(403);
    }
}