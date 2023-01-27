<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
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
        $users = App\Models\User::all();
        $bookings = App\Models\Booking::all();
        $rooms = App\Models\Room::all();


        return view('dashboard', ['users' => $users, 'bookings' => $bookings, 'rooms' => $rooms]);
    })->name('dashboard');


    Route::controller(App\Http\Controllers\RoomController::class)->middleware('role:Admin')
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
            Route::get('/booking/{id}/edit', 'edit')->name('booking.edit');
            Route::put('/booking/{id}/update', 'update')->name('booking.update');

            Route::put('/booking/{id}/{status}/update', 'updateStatus')->name('booking.status.change');


            Route::get('/booking/view/{roomId}', 'view')->name('booking.view.payment');
            Route::post('/booking/store/', 'store')->name('booking.store');
        });
});

Route::controller(App\Http\Controllers\RoomController::class)
    ->group(function () {
        Route::get('/rooms', 'indexGuest')->name('room.guest.index');
    });
