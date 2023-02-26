<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Baubyte\Crypto\Hasher;
use Baubyte\Http\Controller;
use Baubyte\Http\Request;

class RegisterController extends Controller {
    /**
     * Create View
     *
     * @param Request $request
     * @return \Baubyte\Http\Response
     */
    public function create() {
        return view('auth/register');
    }

    /**
     * Save user
     *
     * @param Request $request
     * @return \Baubyte\Http\Response
     */
    public function store(Request $request) {
        $data = $request->validate([
            "email" => ["required", "email"],
            "name" => "required",
            "password" => "required",
            "confirm_password" => "required",
        ]);

        if ($data["password"] !== $data["confirm_password"]) {
            return back()->withErrors([
                "confirm_password" => ["confirm_password" => "Passwords do not match"]
            ]);
        }

        $data["password"] = app(Hasher::class)->hash($data["password"]);

        $user = User::create($data);

        $user->login();

        return redirect('/');
    }
}