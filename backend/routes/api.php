<?php
// backend/routes/api.php

use App\Http\Controllers\API\ActivitiesController;
use App\Http\Controllers\api\BlogController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\Api\BootcampController;
use App\Http\Controllers\api\CompanyFormController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\api\YouthFormController;
use App\Http\Controllers\api\JobOpportunityController;
use App\Http\Controllers\api\UserController;

// public routes --- Endpoint: /api/test
Route::get('/test', function () {
    return " Un-Protected Route ((Test page))";
})->withoutMiddleware('auth:sanctum');

// auth routes
Route::prefix('auth')->group(function () {

    // Endpoint: /api/auth/register
    Route::post('/register', [AuthController::class, 'register']);

    // Endpoint: /api/auth/login
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {

    Route::put('/change-password', [UserController::class, 'changePassword']);
    Route::put('/update-email', [UserController::class, 'updateEmail']);
    Route::put('/youth-forms/{id}', [YouthFormController::class, 'update']);

    // Endpoint: /api/logout
    Route::post('/logout', [AuthController::class, 'logout']);

    //admin Routes
    Route::middleware('role:admin')->group(function () {
        //Endpoint: /api/admin
        Route::get('/admin', function () {
            return "Hello Admin";
        });

        // list other admin routes here :


    });

    //company Routes
    Route::middleware('role:company')->group(function () {
        //Endpoint: /api/company
        Route::get('/company', function () {
            return "Hello Company";
        });

        // list other company routes here :


    });

    //student Routes
    Route::middleware('role:student')->group(function () {
        //Endpoint: /api/student
        Route::get('/student', function () {
            return "Hello Student";
        });

        // list other student routes here :

    });
});


Route::get('/company-forms', [CompanyFormController::class, 'index']);
Route::post('/company-forms', [CompanyFormController::class, 'store']);
Route::get('/company-name/{user_id}', [CompanyFormController::class, 'getCompanyByUserId']);
Route::put('/company-forms/{id}', [CompanyFormController::class, 'update']);




Route::prefix('activities')->group(function () {
    // Get all activities (paginated)
    Route::get('/', [ActivitiesController::class, 'index']);

    // Get a single activity by ID
    Route::get('/{id}', [ActivitiesController::class, 'show']);
});






Route::get('/youth-forms', [YouthFormController::class, 'index']); // Fetch all forms
Route::get('/youth-forms/{id}', [YouthFormController::class, 'show']); // Fetch a single form
Route::post('/youth-forms', [YouthFormController::class, 'store']); // Submit a form
Route::delete('/youth-forms/{id}', [YouthFormController::class, 'destroy']); // Delete a form

Route::post('/contact-us', [ContactUsController::class, 'store']);

Route::get('/bootcamps', [BootcampController::class, 'index']); // Endpoint: /api/bootcamps
Route::get('/bootcamps/{id}', [BootcampController::class, 'show']); // Endpoint: /api/bootcamps/{id}

//JobOpportunity API Routes
Route::get('/job-opportunities', [JobOpportunityController::class, 'index']);

// for Dashboard search modal
Route::get('/users/search', function (Request $request) {
    return User::where('role_id', 1) // Filter by role_id
        ->where(function($query) use ($request) {
            $query->where('name', 'like', "%{$request->q}%")
                  ->orWhere('email', 'like', "%{$request->q}%");
        })
        ->limit(10)
        ->get(['id', 'name', 'email']);
})->withoutMiddleware('auth:sanctum');

//blogs api routes
Route::get('/blogs', [BlogController::class, 'index'])->withoutMiddleware('auth:sanctum');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->withoutMiddleware('auth:sanctum');


