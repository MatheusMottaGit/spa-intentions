<?php

use App\Http\Controllers\IntentionController;
use App\Http\Controllers\UserController;

Route::post('/login', [UserController::class, 'login'])->name('auth.login');
Route::get('/entrar', [UserController::class, 'loginView'])->name('login');

Route::middleware('auth:web')->group(function() {
  Route::post('/logout', [UserController::class, 'logOut'])->name('auth.logOut');
  Route::get('/', [IntentionController::class, 'homeView'])->name('home');
  Route::post('/intentions/create', [IntentionController::class, 'create'])->name('intention.create');
  Route::get('/intencoes', [IntentionController::class, 'intentionsView'])->name('intentions')->middleware('access.control:admin');
  Route::get('/intencoes/{date}', [IntentionController::class, 'intentionsDetailsView'])->name('intentions.details')->middleware('access.control:admin');
});