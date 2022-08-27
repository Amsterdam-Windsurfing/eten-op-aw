<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/dinner-events/upcoming', [\App\Http\Controllers\DinnerEventController::class, 'upcoming']);
Route::post('/dinner-events/create', [\App\Http\Controllers\DinnerEventController::class, 'create']);
Route::patch('/dinner-events/{id}/confirm', [\App\Http\Controllers\DinnerEventController::class, 'confirm']);

Route::post('/event-registrations/create', [\App\Http\Controllers\EventRegistrationController::class, 'create']);
Route::patch('/event-registrations/{id}/confirm', [\App\Http\Controllers\EventRegistrationController::class, 'confirm']);
Route::patch('/event-registrations/{id}/cancel', [\App\Http\Controllers\EventRegistrationController::class, 'cancel']);
