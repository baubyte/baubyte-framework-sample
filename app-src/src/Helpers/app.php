
<?php

use Baubyte\App;
use Baubyte\Container\Container;

/**
 * Easy access to singletons.
 */
function app(string $class = App::class) {
    return Container::resolve($class);
}

/**
 * Create singleton.
 *
 * @param string $class
 * @param callable|string|callable $build
 */
function singleton(string $class, callable|string|null $build = null) {
    return Container::singleton($class, $build);
}
