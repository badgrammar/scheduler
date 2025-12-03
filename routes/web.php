<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkDashboardController;
use App\Http\Controllers\HdDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\TeknisisController;
use App\Http\Controllers\ScheduleController;

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
            Route::get('delete/{id}', [TasksController::class, 'delete'])->name('delete');
            Route::post('update', [TasksController::class, 'update'])->name('update');
            Route::post('plan', [TasksController::class, 'plan'])->name('plan');
        });

    Route::prefix('logs')
        ->as('logs.')
        ->group(function () {
            Route::post('store', [LogsController::class, 'store'])->name('store');
        });

    Route::prefix('teknisi')
        ->as('teknisi.')
        ->group(function () {
            Route::post('store', [TeknisisController::class, 'store'])->name('store');
            Route::get('delete/{id}', [TeknisisController::class, 'delete'])->name('delete');
            Route::get('update', [TeknisisController::class, 'update'])->name('update');
        });

    Route::prefix('schedule')
        ->as('schedule.')
        ->group(function () {
            Route::get('view', [ScheduleController::class, 'index'])->name('view');
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