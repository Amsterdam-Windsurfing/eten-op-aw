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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return redirect('/dinner-events');
    });

    Route::resource('dinner-events', \App\Http\Controllers\DinnerEventController::class);

    Route::resource('event-registrations', \App\Http\Controllers\EventRegistrationController::class);

    Route::resource('users', \App\Http\Controllers\UserController::class);
});
