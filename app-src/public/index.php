<?php
require_once "../vendor/autoload.php";

use Baubyte\Http\HttpNotFoundException;
use Baubyte\Http\Request;
use Baubyte\Routing\Router;
use Baubyte\Server\PhpNativeServer;



$router = new Router();

$router->get('/test', function(Request $request){
    return "GET OK";
});
$router->post('/test', function(Request $request){
    return "POST OK";
});

try {
    $route = $router->resolve(new Request(new PhpNativeServer()));
    $action = $route->action();
    print($action());
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}