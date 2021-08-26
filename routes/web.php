<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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

    Auth::routes(['verify' => true]);
    Route::get('/login-auth', [HomeController::class, 'loginauth']);

    Route::get('/test', function () { //mco0dRl3Ih.png
        Storage::setVisibility('profiles/mco0dRl3Ih.png', 'public');
        dd(Storage::url('mco0dRl3Ih.png'));
    })->middleware('verified');

    Route::middleware(['auth', 'admincheck'])->group(function () {
        Route::prefix('admin')->group(function () {

        });
    });

    Route::middleware(['auth', 'coordinatorcheck', 'verified'])->group(function () {
        Route::prefix('coordinator')->group(function () {

        });
    });

    Route::middleware(['auth', 'volunteercheck', 'verified'])->group(function () {
        Route::prefix('volunteer')->group(function () {
            Route::get('/', function () {
                return "test";
            })->name('v.dashboard');
        });
    });

});


