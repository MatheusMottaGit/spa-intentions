<?php

use App\Http\Controllers\IntentionController;
use App\Http\Controllers\UserController;

Route::post('/sign', [UserController::class, 'sign'])->name('auth.sign');
Route::get('/entrar', [UserController::class, 'signView'])->name('sign');

Route::middleware('auth:web')->group(function() {
  Route::post('/signout', [UserController::class, 'signOut'])->name('auth.signOut');
  Route::get('/', [IntentionController::class, 'homeView'])->name('home');
  Route::post('/intentions/create', [IntentionController::class, 'create'])->name('intention.create');
  Route::get('/intencoes', [IntentionController::class, 'intentionsView'])->name('intentions')->middleware('access.control:admin');
  Route::get('/intencoes/{date}', [IntentionController::class, 'intentionsDetailsView'])->name('intentions.details')->middleware('access.control:admin');
});