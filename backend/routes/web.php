<?php

use App\Http\Controllers\Dashboard\BootcampController;
use App\Http\Controllers\Dashboard\CompanyFormController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardSessionController;
use App\Http\Controllers\Dashboard\JobOpportunityController;
use App\Http\Controllers\Dashboard\YouthFormController;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\Dashboard\AdminTypeController;
use App\Http\Controllers\Dashboard\PermissionController;

// Public login routes
Route::middleware('guest')->group(function () {
    // Login page for unauthenticated users
    Route::get('/login', [DashboardSessionController::class, 'index'])->name('login');
    Route::post('/login', [DashboardSessionController::class, 'login']);
});

// Protected dashboard routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
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


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}/update-status', [UserController::class, 'updateStatus'])->name('users.update-status');





    Route::get('/bootcamps', [BootcampController::class, 'index'])->name('bootcamps.index');
    Route::get('/bootcamps/create', [BootcampController::class, 'create'])->name('bootcamps.create');
    Route::post('/bootcamps', [BootcampController::class, 'store'])->name('bootcamps.store');
    Route::get('/bootcamps/{id}', [BootcampController::class, 'show'])->name('bootcamps.show');
    Route::get('/bootcamps/{id}/edit', [BootcampController::class, 'edit'])->name('bootcamps.edit');
    Route::put('/bootcamps/{id}', [BootcampController::class, 'update'])->name('bootcamps.update');
    Route::delete('/bootcamps/{id}', [BootcampController::class, 'destroy'])->name('bootcamps.destroy');

    Route::get('/job-opportunities', [JobOpportunityController::class, 'index'])->name('job-opportunities.index');

    Route::get('/job-opportunities/create', [JobOpportunityController::class, 'create'])->name('job-opportunities.create');

    Route::get('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'show'])->name('job-opportunities.show');

    Route::post('/job-opportunities', [JobOpportunityController::class, 'store'])->name('job-opportunities.store');
    Route::get('/job-opportunities/{jobOpportunity}/edit', [JobOpportunityController::class, 'edit'])->name('job-opportunities.edit');
    Route::put('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'update'])->name('job-opportunities.update');
    Route::delete('/job-opportunities/{jobOpportunity}', [JobOpportunityController::class, 'destroy'])->name('job-opportunities.destroy');

});

Route::middleware(['auth', CheckPermission::class . ':manage-bootcamps'])->group(function () {
    Route::post('/admin-types', [AdminTypeController::class, 'store']);
    Route::post('/admin-types/{adminType}/users/{user}', [AdminTypeController::class, 'assignToUser']);
});
// Fallback route for '/' (redirect to login if not authenticated)
// Route::redirect('/', '/login');



Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('admin-types', [AdminTypeController::class, 'index'])->name('admin-types.index');
    Route::get('admin-types/create', [AdminTypeController::class, 'create'])->name('admin-types.create');
    Route::post('admin-types', [AdminTypeController::class, 'store'])->name('admin-types.store');
    Route::post('admin-types/{adminType}/assign/{user}', [AdminTypeController::class, 'assignToUser'])
        ->name('admin-types.assign-user');
});



Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
