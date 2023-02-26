<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Baubyte\Http\Controller;
use Baubyte\Crypto\Hasher;
use Baubyte\Http\Request;

/**
 * Login controller.
 */
class LoginController extends Controller{
    /**
     * View Login
     *
     * @return \Baubyte\Http\Response
     */
    public function create(){
        return view('auth/login');
    }

    /**
     * Login user
     *
     * @param Request $request
     * @param Hasher $hasher
     * @return \Baubyte\Http\Response
     */
    public function store(Request $request, Hasher $hasher){
        $data = $request->validate([
            "email" => ["required", "email"],
            "password" => "required",
        ]);

        $user = User::firstWhere('email', $data['email']);

        if (is_null($user) || !$hasher->verify($data["password"], $user->password)) {
            return back()->withErrors([
                'email' => ['email' => 'Credentials do not match']
            ]);
        }

        $user->login();

        return redirect('/');
    }

    /**
     * Logout user
     *
     * @return \Baubyte\Http\Response
     */
    public function destroy(){
        auth()->logout();
        return redirect('/');
    }
}
