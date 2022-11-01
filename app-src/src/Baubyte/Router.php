<?php
namespace Baubyte;

class Router{
    protected array $routes = [];

    public function __construct(){
        foreach (HttpMethod::values() as $method) {
            $this->routes[$method->getValue()] = [];
        }
    }

    public function resolve(string $uri, string $method)
    {
        $action = $this->routes[$method][$uri] ?? null;
        if (is_null($action)) {
            throw new HttpNotFoundException();
        }
        return $action;
    }

    public function get(string $uri, callable $action){
        $this->routes[HttpMethod::GET()->getValue()][$uri] = $action;
    }

    public function post(string $uri, callable $action){
        $this->routes[HttpMethod::POST()->getValue()][$uri] = $action;
    }

    public function put(string $uri, callable $action){
        $this->routes[HttpMethod::PUT()->getValue()][$uri] = $action;
    }

    public function patch(string $uri, callable $action){
        $this->routes[HttpMethod::PATCH()->getValue()][$uri] = $action;
    }

    public function delete(string $uri, callable $action){
        $this->routes[HttpMethod::DELETE()->getValue()][$uri] = $action;
    }
}
