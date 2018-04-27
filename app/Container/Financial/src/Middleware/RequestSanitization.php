<?php

namespace App\Container\Financial\src\Middleware;


use Closure;

class RequestSanitization
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
        $sanitization = [];

        foreach ( $request->all() as $item => $value ) {
            $sanitization[ $item ] =  trim( strip_tags( $value ) );
        }

        return $next( $request->replace( $sanitization ) );
    }
}