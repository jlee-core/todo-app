<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoApiController;

Route::middleware('api.token')->group(function () {
    Route::get('/todos', [TodoApiController::class, 'index']);
    Route::post('/todos', [TodoApiController::class, 'store']);
});