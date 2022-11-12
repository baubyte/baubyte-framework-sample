<?php
require_once "../vendor/autoload.php";

use Baubyte\Http\HttpNotFoundException;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Router;
use Baubyte\Server\PhpNativeServer;



$router = new Router();

$router->get('/test/{param}', function (Request $request) {
    return Response::json($request->routeParameters());
});
$router->post('/test', function(Request $request){
    return Response::json($request->data());
});
$router->get('/redirect', function (Request $request) {
    return Response::redirect("/test");
});

$server = new PhpNativeServer();
try {
    $request = $server->getRequest();
    $route = $router->resolve($request);
    $request->setRoute($route);
    $action = $route->action();
    $response = $action($request);
    $server->sendResponse($response);
} catch (HttpNotFoundException $th) {
    $server->sendResponse(Response::text("Not Found")->setStatus(404));
}