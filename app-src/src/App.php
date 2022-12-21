<?php

namespace Baubyte;

use Baubyte\Container\Container;
use Baubyte\Http\HttpNotFoundException;
use Baubyte\Http\Request;
use Baubyte\Http\Response;
use Baubyte\Routing\Router;
use Baubyte\Server\PhpNativeServer;
use Baubyte\Server\Server;
use Baubyte\Session\PhpNativeSessionStorage;
use Baubyte\Session\Session;
use Baubyte\Validation\Exceptions\ValidationException;
use Baubyte\Validation\Rule;
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
     * View Instance
     *
     * @var \Baubyte\View\View
     */
    public View $view;
    /**
     * Session Instance
     *
     * @var \Baubyte\Session\Session
     */
    public Session $session;
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
        $app->session = new Session(new PhpNativeSessionStorage());
        Rule::loadDefaultRules();
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
                "error" => $th::class,
                "message" => $th->getMessage(),
                "trace" => $th->getTrace()
            ]);
            $this->abort($response->setStatus(500));
        }
    }

    public function abort(Response $response) {
        $this->server->sendResponse($response);
    }
}
