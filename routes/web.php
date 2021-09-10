<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\volunteer\VHomeController;
use Illuminate\Support\Facades\Artisan;

App::setLocale(session('locale'));

Route::get('/command', function () {

    //$code = Artisan::call('storage:link');
    //echo $code;
});

Route::get('language/{locale}', function($locale) {
    session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect('/login');
});

Route::middleware('setlocale')->group(function () {
    Route::prefix('test')->group(function () {
        Route::get('/', [HomeController::class, 'test']);
    });

    Route::get('/', [HomeController::class, 'index']);

    Auth::routes(['verify' => true]);
    Route::get('/login-auth', [HomeController::class, 'loginauth']);

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
            Route::get('/', [VHomeController::class, 'dashboard'])->name('v.dashboard');
        });
    });

});


