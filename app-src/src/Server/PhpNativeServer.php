<?php

namespace Baubyte\Server;

use Baubyte\Http\HttpMethod;
use Baubyte\Http\Request;
use Baubyte\Http\Response;

/**
 * PHP native server that uses `$_SERVER` global.
 */
class PhpNativeServer implements Server {

    /**
     * @inheritDoc
     * @return Request
     */
    public function getRequest(): Request
    {
        return (new Request())
        ->setUri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
        ->setMethod(HttpMethod::from($_SERVER['REQUEST_METHOD']))
        ->setPostData($_POST)
        ->setQueryParameters($_GET);
    }
    /**
     * @inheritDoc
     */
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
