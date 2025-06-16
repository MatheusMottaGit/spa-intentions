<?php

use App\Http\Controllers\ChurchController;
use App\Http\Controllers\IntentionController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/churches', [ChurchController::class, 'listAllChurches'])->middleware('access.control:admin,user');
    
    Route::post('/intentions', [IntentionController::class, 'createIntention'])->middleware('access.control:admin,user');
    Route::get('/intentions', [IntentionController::class, 'listIntentions'])->middleware('access.control:admin');
});

