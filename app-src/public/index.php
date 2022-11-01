<?php

require_once "../vendor/autoload.php";

use Baubyte\HttpNotFoundException;
use Baubyte\Router;

$router = new Router();

$router->get('/test', function(){
    return "GET OK";
});
$router->post('/test', function(){
    return "POST OK";
});

try {
    $action = $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    print($action());
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}