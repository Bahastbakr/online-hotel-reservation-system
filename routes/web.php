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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::controller(App\Http\Controllers\RoomController::class)
        ->group(function () {
            Route::get('/room', 'index')->name('room.index');
            Route::get('/room/create', 'create')->name('room.create');
            Route::post('/room/store', 'store')->name('room.store');
            Route::get('/room/{id}/edit', 'edit')->name('room.edit');
            Route::put('/room/{id}/update', 'update')->name('room.update');
        });

    Route::controller(App\Http\Controllers\BookingController::class)
        ->group(function () {
            Route::get('/booking', 'index')->name('booking.index');
            Route::get('/booking/create', 'create')->name('booking.create');
            Route::post('/booking/store', 'store')->name('booking.store');
            Route::get('/booking/{id}/edit', 'edit')->name('booking.edit');
            Route::put('/booking/{id}/update', 'update')->name('booking.update');
        });
});

Route::controller(App\Http\Controllers\RoomController::class)
    ->group(function () {
        Route::get('/rooms', 'indexGuest')->name('room.guest.index');
    });
