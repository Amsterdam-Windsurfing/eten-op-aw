<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dinner-events/{id}/confirm', [\App\Http\Controllers\DinnerEventController::class, 'confirm'])
    ->middleware('signed')
    ->name('confirmDinnerEvent');
Route::resource('dinner-events', \App\Http\Controllers\DinnerEventController::class);

Route::get('event-registrations/{id}/confirm', [\App\Http\Controllers\EventRegistrationController::class, 'confirm'])
    ->middleware('signed')
    ->name('confirmEventRegistration');
Route::resource('event-registrations', \App\Http\Controllers\EventRegistrationController::class);

Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::get('/', function () {
                return redirect('/admin/dinner-events');
            });

            Route::get('/dinner-events/{id}/pdf', [\App\Http\Controllers\Admin\PDFController::class, 'eventRegistrations'])->name('dinner-events.overview-pdf');

            Route::resource('dinner-events', \App\Http\Controllers\Admin\DinnerEventController::class);

            Route::resource('event-registrations', \App\Http\Controllers\Admin\EventRegistrationController::class);

            Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        });
    });
});

