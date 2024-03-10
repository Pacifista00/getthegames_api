<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;

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

// auth
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// logged user
Route::middleware(['auth:sanctum'])->group(function () {
    // only admin
    Route::middleware(['admin'])->group(function () {
        Route::post('/console/add', [ConsoleController::class, 'store']);
        Route::patch('/console/{id}/update', [ConsoleController::class, 'update']);
        Route::delete('/console/{id}/delete', [ConsoleController::class, 'destroy']);

        Route::post('/game/add', [GameController::class, 'store']);
        Route::patch('/game/{id}/update', [GameController::class, 'update']);
        Route::delete('/game/{id}/delete', [GameController::class, 'destroy']);

        Route::post('/genre/add', [GenreController::class, 'store']);
        Route::patch('/genre/{id}/update', [GenreController::class, 'update']);
        Route::delete('/genre/{id}/delete', [GenreController::class, 'destroy']);
    });

    // admin & user
    Route::get('/consoles', [ConsoleController::class, 'show']);
    Route::get('/games', [GameController::class, 'show']);
    Route::get('/genres', [GenreController::class, 'show']);

    // logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

