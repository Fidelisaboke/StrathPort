<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfLocked;
use App\Http\Middleware\CheckIfActive;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\TransportRequestController;
use App\Http\Controllers\TransportScheduleController;
use App\Http\Controllers\CarpoolRequestController;
use App\Http\Controllers\CarpoolingDetailsController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CarpoolDriver;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\Report;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware([CheckIfActive::class, CheckIfLocked::class])->group(function () {
        /* Dashboard Route */
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        /* Notification Route */
        Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

        /* Student and Staff Routes */
        Route::get('/transport_requests/search', [TransportRequestController::class, 'search'])->name('transport_requests.search');
        Route::get('/transport_requests/filter', [TransportRequestController::class, 'filter'])->name('transport_requests.filter');
        Route::resource('transport_requests', TransportRequestController::class);

        Route::put('/transport_schedules/cancel_trip/{id}', [TransportScheduleController::class, 'cancelTrip'])->name('transport_schedules.cancelTrip');
        Route::put('/transport_schedules/complete_trip/{id}', [TransportScheduleController::class, 'completeTrip'])->name('transport_schedules.completeTrip');
        Route::get('/transport_schedules/search', [TransportScheduleController::class, 'search'])->name('transport_schedules.search');
        Route::resource('transport_schedules', TransportScheduleController::class);

        Route::get('/carpool_requests/search', [CarpoolRequestController::class, 'search'])->name('carpool_requests.search');
        Route::get('/carpool_requests/filter', [CarpoolRequestController::class, 'filter'])->name('carpool_requests.filter');
        Route::resource('carpool_requests', CarpoolRequestController::class);

        Route::put('/carpooling_details/cancel_trip/{id}', [CarpoolingDetailsController::class, 'cancelTrip'])->name('carpooling_details.cancelTrip');
        Route::put('/carpooling_details/complete_trip/{id}', [CarpoolingDetailsController::class, 'completeTrip'])->name('carpooling_details.completeTrip');
        Route::get('/carpooling_details/search', [CarpoolingDetailsController::class, 'search'])->name('carpooling_details.search');
        Route::resource('/carpooling_details', CarpoolingDetailsController::class)->names('carpooling_details');

        /* Carpool Driver Routes */
        Route::prefix('driver')->group(function () {
            Route::get('/carpool_vehicles/search', [CarpoolDriver\CarpoolVehicleController::class, 'search'])->name('driver.carpool_vehicles.search');
            Route::resource('/carpool_vehicles', CarpoolDriver\CarpoolVehicleController::class)->names('driver.carpool_vehicles');

            Route::put('/carpooling_details/cancel_trip/{id}', [CarpoolDriver\CarpoolingDetailsController::class, 'cancelTrip'])->name('driver.carpooling_details.cancelTrip');
            Route::put('/carpooling_details/complete_trip/{id}', [CarpoolDriver\CarpoolingDetailsController::class, 'completeTrip'])->name('driver.carpooling_details.completeTrip');
            Route::get('/carpooling_details/search', [CarpoolDriver\CarpoolingDetailsController::class, 'search'])->name('driver.carpooling_details.search');
            Route::resource('/carpooling_details', CarpoolDriver\CarpoolingDetailsController::class)->names('driver.carpooling_details');

            Route::get('/carpool_requests/search', [CarpoolDriver\CarpoolRequestController::class, 'search'])->name('driver.carpool_requests.search');
            Route::get('/carpool_requests/filter', [CarpoolDriver\CarpoolRequestController::class, 'filter'])->name('driver.carpool_requests.filter');
            Route::resource('carpool_requests', CarpoolDriver\CarpoolRequestController::class)->names('driver.carpool_requests');
        });

        /* Admin Routes */
        Route::prefix('admin')->group(function () {
            // Users
            Route::get('users/search', [Admin\UserController::class, 'search'])->name('admin.users.search');
            Route::resource('users', Admin\UserController::class)->names('admin.users');

            // Transport Requests
            Route::get('transport_requests/report/view', Report\TransportRequestReportController::class)->name('admin.transport_requests.report');
            Route::post('transport_requests/update_status/{id}', [Admin\TransportRequestController::class, 'updateStatus'])->name('admin.transport_requests.update_status');
            Route::get('transport_requests/search', [Admin\TransportRequestController::class, 'search'])->name('admin.transport_requests.search');
            Route::get('transport_requests/filter', [Admin\TransportRequestController::class, 'filter'])->name('admin.transport_requests.filter');
            Route::resource('transport_requests', Admin\TransportRequestController::class)->names('admin.transport_requests');

            // Transport Schedules
            Route::get('transport_schedules/search', [Admin\TransportScheduleController::class, 'search'])->name('admin.transport_schedules.search');
            Route::resource('transport_schedules', Admin\TransportScheduleController::class)->names('admin.transport_schedules');

            // School Drivers

            Route::put('/transport_schedules/cancel_trip/{id}', [Admin\TransportScheduleController::class, 'cancelTrip'])->name('admin.transport_schedules.cancelTrip');
            Route::put('/transport_schedules/complete_trip/{id}', [Admin\TransportScheduleController::class, 'completeTrip'])->name('admin.transport_schedules.completeTrip');
            Route::get('school_drivers/search', [Admin\SchoolDriverController::class, 'search'])->name('admin.school_drivers.search');
            Route::resource('school_drivers', Admin\SchoolDriverController::class)->names('admin.school_drivers');

            // School Vehicles
            Route::get('school_vehicles/search', [Admin\SchoolVehicleController::class, 'search'])->name('admin.school_vehicles.search');
            Route::resource('school_vehicles', Admin\SchoolVehicleController::class)->names('admin.school_vehicles');

            //Carpool Vehicles
            Route::get('carpool_vehicles/search', [Admin\CarpoolVehicleController::class, 'search'])->name('admin.carpool_vehicles.search');
            Route::resource('carpool_vehicles', Admin\CarpoolVehicleController::class)->names('admin.carpool_vehicles');

            //Carpool Drivers
            Route::get('carpool_drivers/search', [Admin\CarpoolDriverController::class, 'search'])->name('admin.carpool_drivers.search');
            Route::get('carpool_drivers/filter', [Admin\CarpoolDriverController::class, 'filter'])->name('admin.carpool_drivers.filter');
            Route::resource('carpool_drivers', Admin\CarpoolDriverController::class)->names('admin.carpool_drivers');
        });

        Route::get('/lock', [LockScreenController::class, 'show'])->name('lock');
        Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
    });
});
