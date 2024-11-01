<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {
    Route::post('/sign', [UserController::class]);
});

Route::middleware('auth:sanctum')->group(function() {
    
});