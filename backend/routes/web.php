<?php

use App\Http\Controllers\Dashboard\CompanyFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardSessionController;
use App\Http\Controllers\Dashboard\JobOpportunityController;
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
    Route::get('/users', fn() => view('dashboard.users.index'))->name('users.index');

    Route::get('/job-opportunities', [JobOpportunityController::class, 'index'])->name('job-opportunities.index');
    Route::get('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'show'])->name('job-opportunities.show');
    Route::get('/job-opportunities/create', [JobOpportunityController::class, 'create'])->name('job-opportunities.create');
    Route::post('/job-opportunities', [JobOpportunityController::class, 'store'])->name('job-opportunities.store');
    Route::get('/job-opportunities/{jobOpportunity}/edit', [JobOpportunityController::class, 'edit'])->name('job-opportunities.edit');
    Route::put('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'update'])->name('job-opportunities.update');
    Route::delete('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'destroy'])->name('job-opportunities.destroy');

});


// Fallback route for '/' (redirect to login if not authenticated)
// Route::redirect('/', '/login');




