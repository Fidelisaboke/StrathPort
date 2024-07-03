<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfLocked;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\TransportRequestController;
use App\Http\Controllers\TransportScheduleController;
use App\Http\Controllers\CarpoolRequestController;
use App\Http\Controllers\CarpoolingDetailsController;
use App\Http\Controllers\CarpoolVehicleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function(){
    return view('about');
})->name('about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(CheckIfLocked::class)->group(function () {
            // Dashboard Route
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            // Student and Staff Routes
            Route::get('/transport_requests/search', [TransportRequestController::class, 'search'])->name('transport_requests.search');
            Route::get('/transport_requests/filter', [TransportRequestController::class, 'filter'])->name('transport_requests.filter');
            Route::resource('transport_requests', TransportRequestController::class);

            Route::get('/transport_schedules/search', [TransportScheduleController::class, 'search'])->name('transport_schedules.search');
            Route::resource('transport_schedules', TransportScheduleController::class);

            Route::get('/carpool_requests/search', [CarpoolRequestController::class, 'search'])->name('carpool_requests.search');
            Route::get('/carpool_requests/filter', [CarpoolRequestController::class, 'filter'])->name('carpool_requests.filter');
            Route::resource('carpool_requests', CarpoolRequestController::class);

            // Carpool Driver Routes
            Route::get('/carpooling_details/search', [CarpoolingDetailsController::class, 'search'])->name('carpooling_details.search');
            Route::resource('/carpooling_details', CarpoolingDetailsController::class);
            Route::resource('/carpool_vehicles', CarpoolVehicleController::class);

            // Admin route group
            Route::middleware(['role:admin'])->group(function () {
                Route::prefix('admin')->group(function () {
                    // Users
                    Route::resource('users', UserController::class);
                });

        });


    Route::get('/lock', [LockScreenController::class, 'show'])->name('lock');
    Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
    });
});
