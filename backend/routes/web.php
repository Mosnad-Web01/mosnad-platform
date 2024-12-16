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
use App\Http\Controllers\Dashboard\BlogController;

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


    //checks manage-job-opportunities permission
    Route::middleware(CheckPermission::class . ':manage-job-opportunities')->group(function () {
        Route::resource('job-opportunities', JobOpportunityController::class);
    });

    // checks manage-users
    Route::middleware(CheckPermission::class . ':manage-users')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}/update-status', [UserController::class, 'updateStatus'])->name('users.update-status');

    });

    //checks manage-bootcamps
    Route::middleware(CheckPermission::class . ':manage-bootcamps')->group(function () {
        Route::resource('bootcamps', BootcampController::class);
    });

    // checks manage-youth-surveys permission
    Route::middleware(CheckPermission::class . ':manage-youth-surveys')->group(function () {
        Route::get('/youth-surveys', [YouthFormController::class, 'index'])->name('youth-surveys.index');
        Route::get('youth-surveys/{id}', [YouthFormController::class, 'show'])->name('youth-surveys.show');
    });
    // checks manage-company-survays permission
    Route::middleware(CheckPermission::class . ':manage-company-survays')->group(function () {
        Route::get('/company-surveys', [CompanyFormController::class, 'index'])->name('company-surveys.index');
        Route::get('/company-surveys/{id}', [CompanyFormController::class, 'show'])->name('company-surveys.show');
    });

    //checks manage-comments permission
    Route::middleware(CheckPermission::class . ':manage-comments')->group(function () {

        Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
        Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('dashboard.contact-us.show');
        Route::post('/contact-us/{id}/reply', [ContactUsController::class, 'reply'])->name('contact-us.reply');
    });


    //checks manage-roles
    Route::middleware(CheckPermission::class . ':manage-roles')->group(function () {

        Route::get('admin-roles', [AdminTypeController::class, 'index'])->name('admin-roles.index');
        Route::get('admin-roles/create', [AdminTypeController::class, 'create'])->name('admin-roles.create');
        Route::post('admin-roles', [AdminTypeController::class, 'store'])->name('admin-roles.store');
        Route::get('admin-roles/{adminType}/edit', [AdminTypeController::class, 'edit'])->name('admin-roles.edit');
        Route::put('admin-roles/{adminType}', [AdminTypeController::class, 'update'])->name('admin-roles.update');
        Route::delete('admin-roles/{adminType}', [AdminTypeController::class, 'destroy'])->name('admin-roles.destroy');


        // Assign admin-type (role) to a user
        Route::post('admin-roles/{adminType}/assign/{user}', [AdminTypeController::class, 'assignToUser'])
            ->name('admin-roles.assign-user');
    });

    //checks manage-permissions
    Route::middleware(CheckPermission::class . ':manage-permissions')->group(function () {

        // allow access to only the index, edit, and update routes
        Route::resource('permissions', PermissionController::class)->only(['index', 'edit', 'update']);

        //return not found in case of of create , store and destroy
        Route::get('/permissions/create', fn() => abort(404));
        Route::post('/permissions', fn() => abort(404));
        Route::delete('/permissions/{permission}', fn() => abort(404));
    });

    Route::middleware(CheckPermission::class . ':manage-blogs')->group(function () {

        // allow access to only the index, edit, and update routes
        Route::resource('blogs', BlogController::class);

    });


});
