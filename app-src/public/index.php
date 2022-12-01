<?php
require_once "../vendor/autoload.php";

use Baubyte\App;
use Baubyte\Http\Middleware;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Route;
use Baubyte\Validation\Rule;
use Baubyte\Validation\Rules\Required;

$app = App::bootstrap();

$app->router->get('/test/{param}', function (Request $request) {
    return json($request->routeParameters());
});
$app->router->post('/test', function (Request $request) {
    return json($request->data());
});
$app->router->get('/redirect', function (Request $request) {
    return redirect("/test/1");
});
class AuthMiddleware implements Middleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers('Authorization') != 'test') {
            return json(["message" => "Not authenticated"])->setStatus(401);
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
Route::get('/middleware', fn (Request $request) => json(["message" => "ok"]))->setMiddlewares([AuthMiddleware::class, TestMiddleware::class]);

Route::get('/html', fn (Request $request) => view('home', ['user' => 'BAUBYTE']));
Route::post('/validate', fn (Request $request) => json($request->validate(
    [
        'test' => 'required',
        'num' => 'number',
        'email' => ['required_when:num,>,5', 'email'],
    ],['email' => ['required' => 'Falta email']])
));
$app->run();
