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
        if (session('locale') == null) {
            App::setLocale('pl');
            session(['locale' => 'pl']);
        } else if (session('locale') != null) {
            App::setLocale(Session::get('locale'));
        } else if (Auth::check()) {
            //App::setLocale('pl');
            App::setLocale(strtolower(Auth::user()->country));
            session(['locale' => Auth::user()->country]);
        }

        return $next($request);
    }
}
