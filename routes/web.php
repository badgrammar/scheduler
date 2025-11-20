<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkDashboardController;
Use App\Http\Controllers\HdDashboardController;

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
