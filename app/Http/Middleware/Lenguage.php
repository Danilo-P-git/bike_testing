<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Lenguage
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
        if(session()->has('lang')) {
            app()->setLocale(session('lang'));
            app()->setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
