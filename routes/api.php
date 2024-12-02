<?php

use App\Http\Controllers\IntentionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::post('/sign', [UserController::class, 'sign'])->name('auth.sign');

// Route::middleware('auth:api')->group(function() {
//   Route::post('/logout', [UserController::class, 'signOut'])->name('auth.signOut');
//   Route::get('/user', [UserController::class, 'getUser'])->name('auth.user.details');
//   Route::get('/intentions/read', [IntentionController::class, 'readAll'])->middleware('access.control:admin');
//   Route::post('/intentions/create', [IntentionController::class, 'create'])->middleware('access.control:admin');
// });