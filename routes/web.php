<?php

use App\Http\Controllers\IntentionController;
use App\Http\Controllers\UserController;

Route::post('/sign', [UserController::class, 'sign'])->name('auth.sign');
Route::get('/entrar', [UserController::class, 'signView'])->name('sign');

Route::middleware('auth:web')->group(function() {
  Route::get('/', [IntentionController::class, 'homeView'])->name('home');
  Route::post('/intentions/create', [IntentionController::class, 'create'])->name('intention.create');
  Route::get('/intentions/read', [IntentionController::class, 'readAll'])->name('intentions.index');
  Route::get('/intencoes', [IntentionController::class, 'intentionsView'])->name('intentions');
});