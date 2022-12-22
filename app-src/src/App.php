<?php

namespace Baubyte;

use Baubyte\Container\Container;
use Baubyte\Database\Drivers\DatabaseDriver;
use Baubyte\Database\Drivers\PdoDriver;
use Baubyte\Database\Model;
use Baubyte\Http\HttpMethod;
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
     * Undocumented variable
     *
     * @var \Baubyte\Database\Drivers\DatabaseDriver
     */
    public DatabaseDriver $database;
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
        $app->database = new PdoDriver();
        $app->database->connect('mysql', 'localhost', 3306, 'framework', 'root', '');
        Model::setDatabaseDriver($app->database);
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
            $this->terminate($response);
        } catch (HttpNotFoundException $e) {
            $this->abort(Response::text("Not Found")->setStatus(404));
        } catch(ValidationException $e) {
            $this->abort(back()->withErrors($e->errors(), 422));
        } catch(Throwable $th) {
            $response = json([
                "error" => $th::class,
                "message" => $th->getMessage(),
                "trace" => $th->getTrace()
            ]);
            $this->abort($response->setStatus(500));
        }
    }

    /**
     * Set session variables or other parameters for the next request.
     */
    public function prepareNextRequest() {
        if ($this->request->method() == HttpMethod::GET()) {
            $this->session->set('_previous', $this->request->uri());
        }
    }

    /**
     * Kill the current process. If necessary, release resources here.
     *
     * @param \Baubyte\Http\Response $response
     */
    public function terminate(Response $response) {
        $this->prepareNextRequest();
        $this->server->sendResponse($response);
        $this->database->close();
        exit();
    }
    /**
     * Stop execution from any point.
     *
     * @param \Baubyte\Http\Response $response
     * @return void
     */
    public function abort(Response $response) {
        $this->terminate($response);
    }
}
