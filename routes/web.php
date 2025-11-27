<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkDashboardController;
use App\Http\Controllers\HdDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;

Route::group(['middleware' => 'auth'], function (){
    Route::prefix('backroom')
        ->as('backroom.')
        ->middleware('role:backroom')
        ->group(function () {
            Route::get('dashboard', [BkDashboardController::class, 'index'])->name('dashboard');
        });

    Route::prefix('helpdesk')
        ->as('helpdesk.')
        ->middleware('role:helpdesk')
        ->group(function () {
            Route::get('dashboard', [HdDashboardController::class, 'index'])->name('dashboard');
        });

    Route::prefix('tasks')
        ->as('tasks.')
        ->group(function () {
            Route::post('store', [TasksController::class, 'store'])->name('store');
        });

    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/test', function (){
        return view('test');
    });
});

Route::group(['middleware' => 'guest'], function (){
    Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('login');
        Route::get('register', [AuthController::class, 'register'])->name('register');
        Route::post('register', [AuthController::class, 'registerUser'])->name('register');
    });

    Route::get('/', [AuthController::class, 'login']);
});