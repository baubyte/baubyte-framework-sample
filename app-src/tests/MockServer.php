<?php

namespace Baubyte\Tests;

use Baubyte\Http\HttpMethod;
use Baubyte\Server\Server as ServerServer;

class MockServer implements ServerServer
{
    public function __construct(
        public string $uri, 
        public HttpMethod $method
        ) {
        $this->uri = $uri;
        $this->method = $method;
    }

    public function requestUri(): string
    {
        return $this->uri;
    }

    public function requestMethod(): HttpMethod
    {
        return $this->method;
    }

    public function postData(): array
    {
        return [];
    }
    
    public function queryParams(): array
    {
        return [];
    }
}
 