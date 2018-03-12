<?php

namespace App\Http\Middleware;

use Closure;

class LangMiddleware
{

    /**
     * The availables languages.
     *
     * @array $languages
     */
    protected $languages = ['en','es'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->exists('lang')) {
            \App::setLocale($request->session()->get('lang'));
        }
        return $next($request);
    }
}
