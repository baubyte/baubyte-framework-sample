<?php

namespace Baubyte\Routing;

use Baubyte\App;
use Baubyte\Container\Container;
use Closure;

/**
 * This class stores the URI regex and action.
 */
class Route {
    /**
     * URI defined in the format `"/route/{param}"`.
     *
     * @var string
     */
    protected string $uri;
    /**
     * Action associated to this URI.
     *
     * @var Closure
     */
    protected Closure $action;
    /**
     * Regular expression used to match incoming requests URIs.
     *
     * @var string
     */
    protected string $regex;
    /**
     * Route parameter names.
     *
     * @var array
     */
    protected array $parameters;
    /**
     * HTTP middlewares
     *
     * @var Baubyte\Http\Middleware[]
     */
    protected array $middlewares = [];

    /**
     * Create a new route with the given URI and action.
     *
     * @param string $uri
     * @param Closure $action
     */
    public function __construct(string $uri, Closure $action) {
        $this->uri = $uri;
        $this->action = $action;
        $this->regex = preg_replace('/\{([a-zA-Z]+)\}/', '([a-zA-Z0-9]+)', $uri);
        preg_match_all('/\{([a-zA-Z]+)\}/', $uri, $parameters);
        $this->parameters = $parameters[1];
    }

    /**
     * Get the URI definition for this route.
     *
     * @return string
     */
    public function uri(): string {
        return $this->uri;
    }

    /**
     * Action that handles requests to this route URI.
     *
     * @return Closure
     */
    public function action(): Closure {
        return $this->action;
    }

    /**
     * Get all HTTP middlewares for this route.
     *
     * @return Baubyte\Http\Middleware[]
     */
    public function middlewares(): array {
        return $this->middlewares;
    }

    /**
     * Set HTTP middlewares for this route.
     *
     * @param array $middlewares
     * @return self
     */
    public function setMiddlewares(array $middlewares): self {
        $this->middlewares = array_map(fn ($middleware) => new $middleware(), $middlewares);
        return $this;
    }

    /**
     * Verify this has middlewares
     *
     * @return boolean
     */
    public function hasMiddlewares(): bool {
        return count($this->middlewares) > 0;
    }
    /**
     * Check if the given `$uri` matches the regex of this route.
     *
     * @param string $uri
     * @return boolean
     */
    public function matches(string $uri): bool {
        return preg_match("#^$this->regex/?$#", $uri);
    }

    /**
     * Check if this route has variable parameters in its definition.
     *
     * @return boolean
     */
    public function hasParameters(): bool {
        return count($this->parameters) > 0;
    }

    /**
     * Get the key-value pairs from the `$uri` as defined by this route.
     *
     * @param string $uri
     * @return array
     */
    public function parseParameters(string $uri): array {
        preg_match("#^$this->regex$#", $uri, $arguments);
        return array_combine($this->parameters, array_slice($arguments, 1));
    }

    public static function get(string $uri, Closure $action): Route {
        return Container::resolve(App::class)->router->get($uri, $action);
    }
}
