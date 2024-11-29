<?php

Route::get('/entrar', function() {
  return view('login');
})->name('login');

Route::middleware('web')->group(function() {
  Route::get('/', function() {
    return view('home');
  })->name('home');
});