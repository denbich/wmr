<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (session('locale') != null) {
            //App::setLocale('pl');
            App::setLocale(Session::get('locale'));
        } else if (Auth::check()) {
            //App::setLocale('pl');
            App::setLocale(strtolower(Auth::user()->country));
        } else {
            App::setLocale('pl');
        }

        return $next($request);
    }
}
