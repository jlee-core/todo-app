<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 入り口(ログイン画面)
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('todos', TodoController::class);
    Route::get('todos/search', [TodoController::class, 'search'])
        ->name('todos.search');
});