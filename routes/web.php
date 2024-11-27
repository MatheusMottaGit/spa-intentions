<?php

Route::get('/entrar', function() {
  return view('login');
})->name('login');

Route::middleware('auth')->group(function() {
  Route::get('/', function() {
    return view('home');
  })->name('home');
});