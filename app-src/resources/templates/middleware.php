<?php

namespace App\Middlewares;

use Baubyte\Http\Middleware;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Closure;

class MiddlewareName implements Middleware {

    /**
     * Handle the request and return a response, or call the next middleware.
     *
     * @param \Baubyte\Http\Request $request
     * @param Closure $next
     * @return \Baubyte\Http\Response
     */
    public function handle(Request $request, Closure $next): Response{
        return $next($request);
    }
}
