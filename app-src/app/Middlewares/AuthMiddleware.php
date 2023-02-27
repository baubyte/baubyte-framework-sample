<?php

namespace App\Middlewares;

use Baubyte\Auth\Auth;
use Baubyte\Http\Middleware;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Closure;

class AuthMiddleware implements Middleware {

    /**
     * Handle the request and return a response, or call the next middleware.
     *
     * @param \Baubyte\Http\Request $request
     * @param Closure $next
     * @return \Baubyte\Http\Response
     */
    public function handle(Request $request, Closure $next): Response{
        if (Auth::isGuest()) {
            return redirect('/login');
        }
        return $next($request);
    }
}
