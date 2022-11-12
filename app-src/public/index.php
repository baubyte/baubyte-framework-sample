<?php
require_once "../vendor/autoload.php";

use Baubyte\App;
use Baubyte\Http\Middleware;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Route;

$app = App::bootstrap();

$app->router->get('/test/{param}', function (Request $request) {
    return Response::json($request->routeParameters());
});
$app->router->post('/test', function(Request $request){
    return Response::json($request->data());
});
$app->router->get('/redirect', function (Request $request) {
    return Response::redirect("/test");
});
class AuthMiddleware implements Middleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers('Authorization') != 'test') {
            return Response::json(["message" => "Not authenticated"])->setStatus(401);
        }
        $response = $next($request);
        $response->setHeader('X-Test-Custom-Header', 'Hello');
        return $response;
    }
}
class TestMiddleware implements Middleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->setHeader('X-Test-Custom-Two', 'Baubyte');
        return $response;
    }
}
Route::get('/middleware', fn (Request $request) => Response::json(["message" => "ok"]))->setMiddlewares([AuthMiddleware::class, TestMiddleware::class]);
$app->run();