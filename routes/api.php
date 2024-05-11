<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

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

// guest
Route::get('/users', [UserController::class, 'shows']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/consoles', [ConsoleController::class, 'shows']);
Route::get('/games', [GameController::class, 'shows']);
Route::get('/console/{id}', [ConsoleController::class, 'show']);
Route::get('/game/{id}', [GameController::class, 'show']);
Route::get('/genres', [GenreController::class, 'show']);

//Midtrans
Route::post('/handleNotification', [OrderController::class, 'handleNotification']);

// logged user
Route::middleware(['auth:sanctum'])->group(function () {
    // only admin
    Route::middleware(['admin'])->group(function () {
        //user
        Route::get('/user', [UserController::class, 'showUser']);

        // console
        Route::post('/console/add', [ConsoleController::class, 'store']);
        Route::post('/console/{id}/update', [ConsoleController::class, 'update']);
        Route::delete('/console/{id}/delete', [ConsoleController::class, 'destroy']);

        // game
        Route::post('/game/add', [GameController::class, 'store']);
        Route::post('/game/{id}/update', [GameController::class, 'update']);
        Route::delete('/game/{id}/delete', [GameController::class, 'destroy']);

        // genre
        Route::post('/genre/add', [GenreController::class, 'store']);
        Route::patch('/genre/{id}/update', [GenreController::class, 'update']);
        Route::delete('/genre/{id}/delete', [GenreController::class, 'destroy']);

        // baskets
        Route::get('/baskets', [BasketController::class, 'show']);
    });

    //user
    Route::post('/user/{id}/update', [UserController::class, 'update']);
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy']);
    
    // basket
    Route::get('/basket', [BasketController::class, 'showUserBasket']);
    Route::post('/basket/console/add', [BasketController::class, 'consoleStore']);
    Route::post('/basket/game/add', [BasketController::class, 'gameStore']);
    Route::post('/basket/{id}/update', [BasketController::class, 'basketUpdate']);
    Route::delete('/basket/{id}/delete', [BasketController::class, 'destroy']);

    //midtrans
    Route::post('/checkout', [OrderController::class, 'checkout']);

    // logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

