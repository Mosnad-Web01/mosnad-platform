<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardSessionController;

// Public login routes
Route::middleware('guest')->group(function () {
    // Login page for unauthenticated users
    Route::get('/login', [DashboardSessionController::class, 'index'])->name('login');
    Route::post('/login', [DashboardSessionController::class, 'login']);
});

// Protected dashboard routes
Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard.index')->name('home');
    Route::post('/logout', [DashboardSessionController::class, 'logout'])->name('logout');
    Route::get('/roles', fn() => 'roles.index')->name('roles.index');
    Route::get('/permissions', fn() => 'permissions.index')->name('permissions.index');
    Route::get('/bootcamps', fn() => 'bootcamps.index')->name('bootcamps.index');
    Route::get('/jobs', fn() => 'jobs.index')->name('jobs.index');
    Route::get('/surveys', fn() => 'surveys.index')->name('surveys.index');
    Route::get('/users', fn() => view('dashboard.users.index'))->name('users.index');
});


// Fallback route for '/' (redirect to login if not authenticated)
// Route::redirect('/', '/login');




