<?php

namespace Baubyte\Auth;

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use Baubyte\Auth\Authenticatable;
use Baubyte\Auth\Authenticators\Authenticator;
use Baubyte\Routing\Route;

/**
 * Authentication facade.
 */
class Auth {
    /**
     * Authentication routes.
     *
     * @return void
     */
    public static function routes() {
        /* Route::get('/login', [LoginController::class, 'show']);
        Route::post('/login', [LoginController::class, 'create']);
        Route::get('/logout', [LoginController::class, 'destroy']);
        Route::get('/register', [RegisterController::class, 'show']);
        Route::post('/register', [RegisterController::class, 'create']); */
    }

    /**
     * Current logged in user.
     *
     * @return Authenticatable|null
     */
    public static function user(): ?Authenticatable {
        return app(Authenticator::class)->resolve();
    }

    /**
     * Check if current request is performed by guest.
     *
     * @return bool
     */
    public static function isGuest(): bool {
        return is_null(self::user());
    }
}
