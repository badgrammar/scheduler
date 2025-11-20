<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkDashboardController;
use App\Http\Controllers\HdDashboardController;
use App\Http\Controllers\AuthController;

Route::prefix('backroom')
    ->as('backroom.')
    ->middleware(['auth', 'role:backroom'])
    ->group(function () {
        Route::get('dashboard', [BkDashboardController::class, 'index']);
    });

Route::prefix('helpdesk')
    ->as('helpdesk.')
    ->middleware(['auth', 'role:helpdesk'])
    ->group(function () {
        Route::get('dashboard', [HdDashboardController::class, 'index']);
    });


Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('login', [AuthController::class, 'login']);
        Route::post('login', [AuthController::class, 'authenticate']);
    });