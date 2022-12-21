<?php

namespace Baubyte\Session;

class Session {
    /**
     * Storage controller.
     *
     * @var SessionStorage
     */
    protected SessionStorage $storage;

    /**
     * Constructor
     *
     * @param SessionStorage $storage
     */
    public function __construct(SessionStorage $storage) {
        $this->storage = $storage;
        $this->storage->start();
    }

    public function flash(string $key, mixed $value) {
    }

    /**
     * Get the ID of the current session.
     *
     * @return string
     */
    public function id(): string {
        return $this->storage->id();
    }

    /**
     * Get a specific key from session storage.
     *
     * @param string $key
     * @param string $default Value to be returned if key is not present.
     * @return mixed
     */
    public function get(string $key, $default = null) {
        return $this->storage->get($key, $default);
    }

    /**
     * Set new key - value pair.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, mixed $value) {
        $this->storage->set($key, $value);
    }

    /**
     * Check if a specific key exists in the session.
     *
     * @param string $key
     * @return boolean
     */
    public function has(string $key): bool {
        return $this->storage->has($key);
    }

    /**
     * Remove specific key exists in the session.
     *
     * @param string $key
     */
    public function remove(string $key) {
        $this->storage->remove($key);
    }

    /**
     * Destroy session.
     */
    public function destroy() {
        $this->storage->destroy();
    }
}
