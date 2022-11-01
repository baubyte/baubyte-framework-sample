<?php
require_once "../vendor/autoload.php";

use Baubyte\Http\HttpNotFoundException;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Router;
use Baubyte\Server\PhpNativeServer;



$router = new Router();

$router->get('/test', function (Request $request) {
    $response = new Response();
    $response->setHeader("Content-Type", "application/json");
    $response->setContent(json_encode(["message" => "GET OK"]));

    return $response;
});
$router->post('/test', function(Request $request){
    return "POST OK";
});

$server = new PhpNativeServer();
try {
    $request = new Request($server);
    $route = $router->resolve($request);
    $action = $route->action();
    $response = $action($request);
    $server->sendResponse($response);
} catch (HttpNotFoundException $th) {
    $response = new Response();
    $response->setStatus(404);
    $server->sendResponse($response);
}