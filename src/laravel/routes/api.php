<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('login', App\Http\Controllers\Auth\AuthLoginController::class);
    Route::post('logout', App\Http\Controllers\Auth\AuthLogoutController::class);
});

Route::prefix('user')->group(function () {
    Route::post('signup', App\Http\Controllers\User\CreateUserController::class);
    Route::get('me', App\Http\Controllers\User\GetUserMeController::class);
    Route::post('attach-role', static fn() => null);
});

Route::prefix('library')->group(function () {
    Route::post('create', App\Http\Controllers\Library\CreateLibraryController::class);
    Route::post('join', App\Http\Controllers\Library\JoinLibraryController::class);
    Route::post('archive', static fn() => null);
});

Route::middleware('custom-auth')->group(function () {
    Route::prefix('book')->group(function () {
        Route::post('register', App\Http\Controllers\Book\RegisterBookController::class);
        Route::post('borrow', App\Http\Controllers\Book\BorrowBookController::class);
        Route::post('return', App\Http\Controllers\Book\ReturnBookController::class);
        Route::post('missing', App\Http\Controllers\Book\MissingBookController::class);
    });
});
