<?php

use Baubyte\Http\Response;
use Baubyte\Routing\Route;

Route::get('/', fn($request)=> Response::text("Baubyte Framework"));
Route::get('/form', fn($request)=> view("form"));