<?php
require_once "./Router.php";
$router = new Router();

$router->get('/test', function(){
    return "GET OK";
});
$router->post('/test', function(){
    return "POST OK";
});

try {
    $action = $router->resolve();
    print($action());
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}