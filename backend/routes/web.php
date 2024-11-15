<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginDashboardController;

// Group routes for the dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {

    // Public login routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginDashboardController::class, 'index'])->name('login');
        Route::post('login', [LoginDashboardController::class, 'login']);
    });

    // Protected dashboard routes
    Route::middleware('auth')->group(function () {
        Route::view('/', 'dashboard.index')->name('index'); // Dashboard home
        Route::post('logout', [LoginDashboardController::class, 'logout'])->name('logout');
    });
});

// Fallback route for `/login`
Route::get('/login', [LoginDashboardController::class, 'index'])
    ->name('login')
    ->middleware('guest');
