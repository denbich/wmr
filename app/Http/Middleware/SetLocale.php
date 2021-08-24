<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('locale') != null) {
            App::setLocale(Session::get('locale'));
        } else if (Auth::check()) {
            App::setLocale(strtolower(Auth::user()->country));
        } else {
            App::setLocale(strtolower("PL"));
        }

        return $next($request);
    }
}
