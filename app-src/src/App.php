<?php

namespace Baubyte;

use Baubyte\Container\Container;
use Baubyte\Http\HttpNotFoundException;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Router;
use Baubyte\Server\PhpNativeServer;
use Baubyte\Server\Server;
use Baubyte\Validation\Exceptions\ValidationException;
use Baubyte\View\BaubyteEngine;
use Baubyte\View\View;
use Throwable;

/**
 * App runtime.
 */
class App {
    /**
     * Router instance.
     *
     * @var \Baubyte\Routing\Router
     */
    public Router $router;
    /**
     * Current HTTP request.
     *
     * @var \Baubyte\Http\Request
     */
    public Request $request;
    /**
     * Server Instance
     *
     * @var \Baubyte\Server\Server
     */
    public Server $server;

    /**
     * Undocumented variable
     *
     * @var \Baubyte\View\View
     */
    public View $view;

    /**
     * Create a new app instance.
     *
     * @return self
     */
    public static function bootstrap(): self {
        $app = singleton(self::class);
        $app->router = new Router();
        $app->server = new PhpNativeServer();
        $app->request = $app->server->getRequest();
        $app->view = new BaubyteEngine(__DIR__.'/../views');
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
        } catch (HttpNotFoundException $e) {
            $this->abort(Response::text("Not Found")->setStatus(404));
        } catch(ValidationException $e) {
            $this->abort(json($e->errors())->setStatus(422));
        } catch(Throwable $th) {
            $response = json([
                "message" => $th->getMessage(),
                "trace" => $th->getTrace()
            ]);
            $this->abort($response);
        }
    }

    public function abort(Response $response) {
        $this->server->sendResponse($response);
    }
}
