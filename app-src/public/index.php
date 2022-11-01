<?php

require_once "../vendor/autoload.php";

use Baubyte\HttpNotFoundException;
use Baubyte\Request;
use Baubyte\Router;
use Baubyte\Server;

$router = new Router();

$router->get('/test', function(){
    return "GET OK";
});
$router->post('/test', function(){
    return "POST OK";
});

try {
    $route = $router->resolve(new Request(new Server()));
    $action = $route->action();
    print($action());
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}