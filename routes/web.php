<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\volunteer\VChatController;
use App\Http\Controllers\volunteer\VHomeController;
use App\Http\Controllers\volunteer\VFormsController;
use App\Http\Controllers\volunteer\VPostsController;
use App\Http\Controllers\coordinator\CChatController;
use App\Http\Controllers\coordinator\CHomeController;
use App\Http\Controllers\volunteer\VPrizesController;
use App\Http\Controllers\coordinator\CFormsController;
use App\Http\Controllers\coordinator\CPostsController;
use App\Http\Controllers\coordinator\CPrizesController;
use App\Http\Controllers\coordinator\CVolunteerController;

App::setLocale(session('locale'));

Route::get('language/{locale}', function($locale) {
    session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect('/login');
});

Route::middleware('setlocale')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/volunteer-id/{volunteer}', [HomeController::class, 'volunteer'])->name('volunteer.id');

    Auth::routes(['verify' => true]);

    Route::middleware('auth')->group(function () {
        Route::get('/login-auth', [HomeController::class, 'loginauth']);
        Route::get('/new-agreement', [HomeController::class, 'new_agreement'])->middleware('volunteercheck')->name('new.agreement');
        Route::post('/new-agreement', [HomeController::class, 'update_agreement']);
    });

    Route::middleware(['auth', 'admincheck'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AHomeController::class, 'dashboard'])->name('a.dashboard');
        });
    });

    Route::middleware(['auth', 'coordinatorcheck', 'verified'])->group(function () {

        Route::get('/test', [VFormsController::class, 'test']);

        Route::prefix('command')->group(function () {
            Route::get('/migrate', function () { $code = Artisan::call('migrate', [ '--force' => true]); echo $code; });
            Route::get('/migrate-rollback', function () { $code = Artisan::call('migrate:rollback', [ '--force' => true]); echo $code; });
            Route::get('/storage-link', function () { $code = Artisan::call('storage:link', [ '--force' => true]); echo $code; });
        });

        Route::prefix('coordinator')->group(function () {
            Route::get('/', [CHomeController::class, 'dashboard'])->name('c.dashboard');
            Route::get('/settings', [CHomeController::class, 'settings'])->name('c.settings');
            Route::post('/settings', [CHomeController::class, 'save_settings']);
            Route::get('/profile', [CHomeController::class, 'profile'])->name('c.profile');
            Route::post('/profile', [CHomeController::class, 'update_profile']);
            Route::post('/change-photo', [CHomeController::class, 'change_photo'])->name('c.change.profile');
            Route::get('/calendar', [CHomeController::class, 'calendar'])->name('c.calendar');
            Route::get('/load-events', [CHomeController::class, 'load_events'])->name('c.loadevents');
            Route::get('/info', [CHomeController::class, 'info'])->name('c.info');
            Route::get('/maps', [CHomeController::class, 'maps'])->name('c.maps');

            Route::get('/update-volunteer', [CHomeController::class, 'update_v'])->name('c.update.v');
            Route::post('/update-volunteer', [CHomeController::class, 'update_volunteer']);

            Route::prefix('chat')->group(function() {
                Route::get('/', [CChatController::class, 'chat'])->name('c.chat');
                Route::post('/getallmessages', [CChatController::class, 'getallmessages']);
                Route::post('/getmessages', [CChatController::class, 'getmessages']);
                Route::post('/getmessage', [CChatController::class, 'getmessage']);
                Route::post('/sendmessage', [CChatController::class, 'sendmessage']);
            });

            Route::prefix('volunteer')->group(function() {
                Route::get('/', [CVolunteerController::class, 'list'])->name('c.v.list');
                Route::get('/list', [CVolunteerController::class, 'pdf_list'])->name('c.v.pdflist');
                Route::get('/id/{id}', [CVolunteerController::class, 'volunteer']);
                Route::get('/search', [CVolunteerController::class, 'search'])->name('c.v.search');
                Route::get('/active', [CVolunteerController::class, 'active'])->name('c.v.active');
                Route::post('/active', [CVolunteerController::class, 'activation']);
                Route::post('/dactive', [CVolunteerController::class, 'dactivation'])->name('c.v.dactive');
                Route::get('/agreement/{volunteer}', [CVolunteerController::class, 'agreement'])->name('c.v.agreement');
                Route::get('/birthday', [CVolunteerController::class, 'birthday'])->name('c.v.birthday');
            });

            Route::get('/forms/archive', [CFormsController::class, 'archive'])->name('c.form.archive');
            Route::get('/forms/list/{id}', [CFormsController::class, 'volunteer_list'])->name('c.form.volunteers');

            Route::post('/forms/stop-sign/{id}', [CFormsController::class, 'stop_sign'])->name('c.form.stopsign');
            Route::post('/forms/start-sign/{id}', [CFormsController::class, 'start_sign'])->name('c.form.startsign');

            Route::get('/forms/positions/{id}', [CFormsController::class, 'positions'])->name('c.form.positions');
            Route::post('/forms/positions/{id}', [CFormsController::class, 'set_positions']);

            Route::get('/forms/presence/{id}', [CFormsController::class, 'presence'])->name('c.form.presence');
            Route::post('/forms/presence/{id}', [CFormsController::class, 'save_presence']);
            Route::get('/forms/view-presence/{id}', [CFormsController::class, 'view_presence'])->name('c.form.viewpresence');

            Route::resource('/forms', CFormsController::class, ['names' => [
                'index' => 'c.form.list', 'create' => 'c.form.create', 'store' => 'c.form.store', 'show' => 'c.form.show',
                'edit' => 'c.form.edit', 'update' => 'c.form.update', 'destroy' => 'c.form.destroy',
            ]]);

            Route::get('/prizes/search', [CPrizesController::class, 'search'])->name('c.prize.search');
            Route::get('/prizes/orders', [CPrizesController::class, 'orders'])->name('c.prize.orders');
            Route::get('/prizes/orders/{id}', [CPrizesController::class, 'order'])->name('c.prize.order');
            Route::post('/prizes/orders/change-status/{id}', [CPrizesController::class, 'change_status']);
            Route::post('/prizes/update-quantity/{id}', [CPrizesController::class, 'update_quantity'])->name('c.prize.updatequantity');
            Route::resource('/prizes', CPrizesController::class, ['names' => [
                'index' => 'c.prize.list', 'create' => 'c.prize.create', 'store' => 'c.prize.store', 'show' => 'c.prize.show',
                'edit' => 'c.prize.edit', 'update' => 'c.prize.update', 'destroy' => 'c.prize.destroy',
            ]]);

            Route::resource('/posts', CPostsController::class, ['names' => [
                'index' => 'c.post.list', 'create' => 'c.post.create', 'store' => 'c.post.store', 'show' => 'c.post.show',
                'edit' => 'c.post.edit', 'update' => 'c.post.update', 'destroy' => 'c.post.destroy',
            ]]);

        });
    });

    Route::middleware(['auth', 'volunteercheck', 'verified', 'agreementcheck'])->group(function () {
        Route::prefix('volunteer')->group(function () {
            Route::get('/', [VHomeController::class, 'dashboard'])->name('v.dashboard');
            Route::get('/settings', [VHomeController::class, 'settings'])->name('v.settings');
            Route::post('/settings', [VHomeController::class, 'save_settings']);
            Route::get('/profile', [VHomeController::class, 'profile'])->name('v.profile');
            Route::post('/profile', [VHomeController::class, 'save_profile']);
            Route::post('/change-photo', [VHomeController::class, 'change_photo'])->name('v.change.profile');
            Route::get('/calendar', [VHomeController::class, 'calendar'])->name('v.calendar');
            Route::get('/load-events', [VHomeController::class, 'load_events'])->name('v.loadevents');
            Route::get('/info', [VHomeController::class, 'info'])->name('v.info');
            Route::get('/id', [VHomeController::class, 'id'])->name('v.id');
            Route::get('/maps', [VHomeController::class, 'maps'])->name('v.maps');//mailtest
            //Route::get('/test', [VHomeController::class, 'mailtest']);

            Route::prefix('/chat')->group(function() {
                Route::get('/', [VChatController::class, 'chat'])->name('v.chat');
            });

            Route::prefix('/posts')->group(function() {
                Route::get('/', [VPostsController::class, 'list'])->name('v.post.list');
                Route::get('/{id}', [VPostsController::class, 'post'])->name('v.post');
            });

            Route::prefix('/forms')->group(function() {
                Route::get('/', [VFormsController::class, 'list'])->name('v.form.list');
                Route::get('/archive', [VFormsController::class, 'archive'])->name('v.form.archive');
                Route::get('/id/{id}', [VFormsController::class, 'form'])->name('v.form.show');
                Route::post('/id/{id}', [VFormsController::class, 'signto']);
                Route::post('/delete/{id}', [VFormsController::class, 'unsign'])->name('v.form.unsign');
                Route::post('/certificate', [VFormsController::class, 'certificate'])->name('v.form.certificate');
                Route::post('/feedback/{id}', [VFormsController::class, 'feedback'])->name('v.form.feedback');
            });

            Route::prefix('/prizes')->group(function() {
                Route::get('/', [VPrizesController::class, 'list'])->name('v.prize.list');
                Route::get('/id/{id}', [VPrizesController::class, 'prize'])->name('v.prize');
                Route::post('/get-prize/{id}', [VPrizesController::class, 'get_prize'])->name('v.prize.get');
                Route::get('/orders', [VPrizesController::class, 'orders'])->name('v.prize.orders');
            });

        });
    });

});


