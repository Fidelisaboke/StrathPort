<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfLocked;
use App\Http\Controllers\LockScreenController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware(CheckIfLocked::class);

    Route::get('/lock', [LockScreenController::class, 'show'])->name('lock');
    Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
});
