<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\volunteer\VHomeController;
use App\Http\Controllers\coordinator\CChatController;
use App\Http\Controllers\coordinator\CHomeController;
use App\Http\Controllers\coordinator\CVolunteerController;

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
        Route::get('/chat', [HomeController::class, 'chat']);
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
            Route::get('/', [CHomeController::class, 'dashboard'])->name('c.dashboard');
            Route::get('/settings', [CHomeController::class, 'settings'])->name('c.settings');
            Route::get('/profile', [CHomeController::class, 'profile'])->name('c.profile');
            Route::get('/calendar', [CHomeController::class, 'calendar'])->name('c.calendar');
            Route::get('/info', [CHomeController::class, 'info'])->name('c.info');

            Route::prefix('chat')->group(function() {
                Route::get('/', [CChatController::class, 'chat'])->name('c.chat');
                Route::post('/getallmessages', [CChatController::class, 'getallmessages']);
                Route::post('/getmessages', [CChatController::class, 'getmessages']);
                Route::post('/getmessage', [CChatController::class, 'getmessage']);
                Route::post('/sendmessage', [CChatController::class, 'sendmessage']);
            });

            Route::prefix('volunteer')->group(function() {
                Route::get('/', [CVolunteerController::class, 'list'])->name('c.v.list');
                Route::get('/id/{id}', [CVolunteerController::class, 'volunteer']);
            });
        });
    });

    Route::middleware(['auth', 'volunteercheck', 'verified'])->group(function () {
        Route::prefix('volunteer')->group(function () {
            Route::get('/', [VHomeController::class, 'dashboard'])->name('v.dashboard');
        });
    });

});


