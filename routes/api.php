<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ConsoleController;

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
    });

    // admin & user
    Route::get('/consoles', [ConsoleController::class, 'show']);

    // logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

