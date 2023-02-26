<?php

use App\Models\User;
use Baubyte\Auth\Auth;
use Baubyte\Http\Response;
use Baubyte\Routing\Route;

Auth::routes();

Route::get('/', function () {
    if (isGuest()) {
        return Response::text('Guest');
    }
    return Response::text(auth()->name);
});

Route::get('/form', fn () => view('form'));
Route::get('/user/{user}', fn (User $user) => json($user->toArray()));

Route::get('/route/{param}', fn (string $param) => json(["param" => $param]));
