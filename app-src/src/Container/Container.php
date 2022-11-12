<?php

namespace Baubyte\Container;

/**
 * Service container.
 */
class Container {
    /**
     * Unique instances of each registered class.
     *
     * @var array
     */
    private static array $instances = [];

    /**
     * Register a class to be stored as a singleton.
     *
     * @param string $class
     */
    public static function singleton(string $class) {
        if (!array_key_exists($class, static::$instances)) {
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }

    /**
     * Get the singleton instance of the given class.
     *
     * @param string $class
     */
    public static function resolve(string $class) {
        return self::$instances[$class] ?? null;
    }
}
