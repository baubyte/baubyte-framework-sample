<?php

use Baubyte\Session\Session;

/**
 * Get session instance.
 */
function session(): Session {
    return app()->session;
}
