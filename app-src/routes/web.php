<?php

use App\Models\User;
use Baubyte\Crypto\Hasher;
use Baubyte\Http\Response;
use Baubyte\Routing\Route;

Route::get('/', fn($request)=> Response::text(auth()->name));
Route::get('/form', fn($request)=> view("form"));

Route::get('/register', fn($request)=> view("auth/register"));

Route::post('/register', function($request){
    $data = $request->validate([
        "email" => "required|email",
        "name" => "required",
        "password" => "required",
        "confirm_password" => "required",
    ]);

    if ($data["password"] !== $data["confirm_password"]) {
        return back()->withErrors([
            "confirm_password" => ["confirm_password" => "Las Contraseñas no Coinciden"]
        ]);
    }

    $data["password"] = app(Hasher::class)->hash($data["password"]);
    
    User::create($data);

    $user = User::firstWhere('email', $data['email']);

    $user->login();

    return redirect('/');
});