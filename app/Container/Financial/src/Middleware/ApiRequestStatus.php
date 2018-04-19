<?php

namespace App\Container\Financial\src\Middleware;


use Closure;

class ApiRequestStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return ( $request->ajax() ) ? $next($request) : abort(403);
    }
}