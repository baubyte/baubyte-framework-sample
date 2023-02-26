<?php

use App\Models\User;
use Baubyte\Auth\Auth;
use Baubyte\Http\Request;
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

Route::get('/picture', fn () => view('form_picture'));

Route::post('/picture', function (Request $request) {
    $url = $request->file('picture')->store();
    return Response::text($url);
});

Route::post('/picture', function (Request $request) {
    $url = $request->file('picture')->store('test/pictures');
    return Response::text($url);
});
