<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('store-url', [App\Http\Controllers\UrlController::class, 'store']);
Route::get('/s/{slug}', [App\Http\Controllers\UrlController::class, 'goToRoute']);
