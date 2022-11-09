<?php

namespace Baubyte\Server;

use Baubyte\Http\HttpMethod;
use Baubyte\Http\Response;
/**
 * Similar to PHP `$_SERVER` but having an interface allows us to mockup these
 * global variables, useful for testing.
 */
interface Server
{
    /**
     * Get request URI.
     *
     * @return string
     */
    public function requestUri(): string;

    /**
     * Get request HTTP method.
     *
     * @return HttpMethod
     */
    public function requestMethod(): HttpMethod;

    /**
     * Get request POST data.
     *
     * @return array
     */
    public function postData(): array;

    /**
     * Get request query parameters.
     *
     * @return array
     */
    public function queryParams(): array;

    /**
     * Send the response to the client.
     *
     * @param Response $response
     * @return void
     */
    public function sendResponse(Response $response);
}
