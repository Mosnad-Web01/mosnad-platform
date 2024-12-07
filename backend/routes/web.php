<?php

use App\Http\Controllers\Dashboard\BootcampController;
use App\Http\Controllers\Dashboard\CompanyFormController;
use App\Http\Controllers\Dashboard\ContactUsController;
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
    Route::get('/company-surveys/{id}', [CompanyFormController::class, 'show'])->name('company-surveys.show');
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('dashboard.contact-us.show');
    Route::post('/contact-us/{id}/reply', [ContactUsController::class, 'reply'])->name('contact-us.reply');
    Route::get('/users', fn() => view('dashboard.users.index'))->name('users.index');




    Route::get('/bootcamps', [BootcampController::class, 'index'])->name('bootcamps.index');
    Route::get('/bootcamps/create', [BootcampController::class, 'create'])->name('bootcamps.create');
    Route::post('/bootcamps', [BootcampController::class, 'store'])->name('bootcamps.store');
    Route::get('/bootcamps/{id}', [BootcampController::class, 'show'])->name('bootcamps.show');
    Route::get('/bootcamps/{id}/edit', [BootcampController::class, 'edit'])->name('bootcamps.edit');
    Route::put('/bootcamps/{id}', [BootcampController::class, 'update'])->name('dashboard.bootcamps.update');  // This is the route you're missing
    Route::delete('/bootcamps/{id}', [BootcampController::class, 'destroy'])->name('bootcamps.destroy');

    Route::get('/job-opportunities', [JobOpportunityController::class, 'index'])->name('job-opportunities.index');
    
    Route::get('/job-opportunities/create', [JobOpportunityController::class, 'create'])->name('job-opportunities.create');

    Route::get('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'show'])->name('job-opportunities.show');

    Route::post('/job-opportunities', [JobOpportunityController::class, 'store'])->name('job-opportunities.store');
    Route::get('/job-opportunities/{jobOpportunity}/edit', [JobOpportunityController::class, 'edit'])->name('job-opportunities.edit');
    Route::put('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'update'])->name('job-opportunities.update');
    Route::delete('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'destroy'])->name('job-opportunities.destroy');

});


// Fallback route for '/' (redirect to login if not authenticated)
// Route::redirect('/', '/login');
