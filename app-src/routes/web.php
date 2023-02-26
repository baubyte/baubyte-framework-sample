<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Models\User;
use Baubyte\Http\Response;
use Baubyte\Routing\Route;

Route::get('/', function () {
    if (isGuest()) {
        return Response::text('Guest');
    }
    return Response::text(auth()->name);
});

Route::get('/form', fn () => view('form'));
Route::get('/user/{user}', fn (User $user) => json($user->toArray()));

Route::get('/route/{param}', fn (string $param) => json(["param" => $param]));

Route::get('/register', [RegisterController::class, 'create']);

Route::post('/register', [RegisterController::class, 'store']);


Route::get('/login', [LoginController::class, 'create']);

Route::post('/login', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'destroy']);