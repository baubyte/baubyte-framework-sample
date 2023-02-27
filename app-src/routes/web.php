<?php

use Baubyte\Routing\Route;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use Baubyte\Auth\Auth;

Auth::routes();

Route::get('/', fn () => redirect('/home'));
Route::get('/home', [HomeController::class, 'index']);

Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/contacts/create', [ContactController::class, 'create']);
Route::post('/contacts', [ContactController::class, 'store']);
