<?php

namespace Baubyte;

use Baubyte\Container\Container;
use Baubyte\Http\HttpNotFoundException;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Router;
use Baubyte\Server\PhpNativeServer;
use Baubyte\Server\Server;

/**
 * App runtime.
 */
class App {
    /**
     * Router instance.
     *
     * @var Router
     */
    public Router $router;
    /**
     * Current HTTP request.
     *
     * @var Request
     */
    public Request $request;
    /**
     * Server Instance
     *
     * @var Server
     */
    public Server $server;

    /**
     * Create a new app instance.
     *
     * @return self
     */
    public static function bootstrap(): self {
        $app = Container::singleton(self::class);
        $app->router = new Router();
        $app->server = new PhpNativeServer();
        $app->request = $app->server->getRequest();
        return $app;
    }
    /**
     * Handle request and send response.
     *
     */
    public function run() {
        try {
            $response = $this->router->resolve($this->request);
            $this->server->sendResponse($response);
        } catch (HttpNotFoundException $th) {
            $this->server->sendResponse(Response::text("Not Found")->setStatus(404));
        }
    }
}
