<?php

use App\Http\Controllers\Dashboard\CompanyFormController;
use App\Http\Controllers\Dashboard\ContactUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardSessionController;
use App\Http\Controllers\Dashboard\YouthFormController;

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
    Route::get('/youth-surveys', [YouthFormController::class, 'index'])->name('youth-surveys.index');
    Route::get('youth-surveys/{id}', [YouthFormController::class, 'show'])->name('youth-surveys.show');
    Route::get('/company-surveys', [CompanyFormController::class, 'index'])->name('company-surveys.index');
    Route::get('/company-surveys/{id}', [CompanyFormController::class, 'show'])->name('company-surveys.show');
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('dashboard.contact-us.show');
    Route::post('/contact-us/{id}/reply', [ContactUsController::class, 'reply'])->name('dashboard.contact-us.reply');
    Route::get('/users', fn() => view('dashboard.users.index'))->name('users.index');
});


// Fallback route for '/' (redirect to login if not authenticated)
// Route::redirect('/', '/login');
