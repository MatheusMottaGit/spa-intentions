<?php

use App\Http\Controllers\IntentionController;
use App\Http\Controllers\UserController;

Route::post('/sign', [UserController::class, 'sign'])->name('auth.sign');
Route::get('/entrar', [UserController::class, 'signForm'])->name('sign');

Route::middleware('auth:web')->group(function() {
  Route::get('/', [IntentionController::class, 'home'])->name('home');
  Route::get('/user', [UserController::class, 'getUser'])->name('auth.user.details');
});