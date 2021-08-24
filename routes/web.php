<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

App::setLocale(session('locale'));

Route::get('language/{locale}', function($locale) {
    session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect('/login');
});

Route::middleware('setlocale')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();
    Route::get('/login-auth', [HomeController::class, 'loginauth']);

    Route::middleware(['auth', 'admincheck'])->group(function () {

    });

    Route::middleware(['auth', 'coordinatorcheck'])->group(function () {

    });

    Route::middleware(['auth', 'volunteercheck'])->group(function () {

    });

});


