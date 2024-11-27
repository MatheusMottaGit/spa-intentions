<?php

use App\Http\Controllers\IntentionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/sign', [UserController::class, 'sign'])->name('user.sign');

Route::middleware('auth')->group(function() {
  Route::get('/intentions/read', [IntentionController::class, 'readAll'])->middleware('access.control:admin');
  Route::post('/intentions/create', [IntentionController::class, 'create'])->middleware('access.control:admin');
});