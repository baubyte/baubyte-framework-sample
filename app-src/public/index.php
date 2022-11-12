<?php
require_once "../vendor/autoload.php";

use Baubyte\App;
use Baubyte\Http\Request;
use Baubyte\Http\Response;

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

$app->run();