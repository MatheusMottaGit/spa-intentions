<?php

Route::get('/entrar', function() {
  return view('login');
});

Route::middleware('auth:sanctum')->group(function() {
  Route::get('/', function() {
    return view('home');
  });
});