<?php
// backend/routes/api.php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CompanyFormController;

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

