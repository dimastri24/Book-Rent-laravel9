<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PublicController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::middleware('only-client')->group(function () {
        Route::get('/profile', [UserController::class, 'profile']);
        Route::get('/rent-book/{slug}', [BookRentController::class, 'show']);
        Route::post('/rent-book', [BookRentController::class, 'rent']);
    });


    Route::middleware('only-admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::prefix('books')->group(function () {
            Route::get('/', [BookController::class, 'index']);
            Route::get('/add', [BookController::class, 'add']);
            Route::post('/add', [BookController::class, 'store']);
            Route::get('/edit/{slug}', [BookController::class, 'edit']);
            Route::put('/edit/{slug}', [BookController::class, 'update']);
            Route::post('/delete/{slug}', [BookController::class, 'delete']);
            Route::delete('/remove/{slug}', [BookController::class, 'remove']);
            Route::get('/deleted', [BookController::class, 'viewDeleted']);
            Route::get('/restore/{slug}', [BookController::class, 'restore']);
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/add', [CategoryController::class, 'add']);
            Route::post('/add', [CategoryController::class, 'store']);
            Route::get('/edit/{slug}', [CategoryController::class, 'edit']);
            Route::put('/edit/{slug}', [CategoryController::class, 'update']);
            Route::get('/delete/{slug}', [CategoryController::class, 'delete']);
            Route::get('/remove/{slug}', [CategoryController::class, 'remove']);
            Route::get('/deleted', [CategoryController::class, 'viewDeleted']);
            Route::get('/restore/{slug}', [CategoryController::class, 'restore']);
            Route::get('/destroy/{slug}', [CategoryController::class, 'destroy']);
        });

        Route::get('/book-rent', [BookRentController::class, 'index']);
        Route::post('/book-rent', [BookRentController::class, 'store']);
        Route::get('/book-return', [BookRentController::class, 'bookReturn']);
        Route::get('/book-return-detail', [BookRentController::class, 'bookReturnDetail']);
        Route::post('/book-return', [BookRentController::class, 'storeBookReturn']);

        Route::get('/rent-logs', [RentLogController::class, 'index']);

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/registered-users', [UserController::class, 'registeredUser']);
            Route::get('/detail/{slug}', [UserController::class, 'show']);
            Route::get('/approve/{slug}', [UserController::class, 'approve']);
            Route::get('/ban/{slug}', [UserController::class, 'delete']);
            Route::get('/remove/{slug}', [UserController::class, 'remove']);
            Route::get('/banned', [UserController::class, 'viewDeleted']);
            Route::get('/restore/{slug}', [UserController::class, 'restore']);
        });
        // end of only admin
    });
});
