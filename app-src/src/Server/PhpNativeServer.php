<?php

namespace Baubyte\Server;

use Baubyte\Http\HttpMethod;
use Baubyte\Http\Response;

class PhpNativeServer implements Server
{
    public function requestUri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function requestMethod(): HttpMethod
    {
        return HttpMethod::from($_SERVER['REQUEST_METHOD']);
    }

    public function postData(): array
    {
        return $_POST;
    }
    
    public function queryParams(): array
    {
        return $_GET;
    }


    public function sendResponse(Response $response) {
        /**
         * PHP envía el encabezado Content-Type de forma predeterminada, pero debe eliminarse si
         * la respuesta no tiene contenido. El encabezado de tipo de contenido no se puede eliminar
         * a menos que se establezca en algún valor antes.
        */
        header("Content-Type: None");
        header_remove("Content-Type");

        $response->prepare();
        http_response_code($response->status());
        foreach ($response->headers() as $header => $value) {
            header("$header: $value");
        }
        print($response->content());
    }
}
