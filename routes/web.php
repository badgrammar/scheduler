<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkDashboardController;
use App\Http\Controllers\HdDashboardController;
use App\Http\Controllers\AuthController;

Route::prefix('backroom')
    ->as('backroom.')
    ->middleware(['auth', 'role:backroom'])
    ->group(function () {
        Route::get('dashboard', [BkDashboardController::class, 'index'])->name('dashboard');
    });

Route::prefix('helpdesk')
    ->as('helpdesk.')
    ->middleware(['auth', 'role:helpdesk'])
    ->group(function () {
        Route::get('dashboard', [HdDashboardController::class, 'index'])->name('dashboard');
    });


Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('login');
        Route::get('register', [AuthController::class, 'register'])->name('register');
        Route::post('register', [AuthController::class, 'registerUser'])->name('register');
    });

Route::get('/', [AuthController::class, 'login']);