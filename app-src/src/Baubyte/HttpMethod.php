<?php
namespace Baubyte;

use Baubyte\Abstract\Enum;
/* 
PHP 8.1
enum HttpMethod: string {
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
}
 */
/**
 * Compatibility for PHP 7
 */
final class HttpMethod extends Enum{
    private const GET = "GET";
    private const POST = "POST";
    private const PUT = "PUT";
    private const PATCH = "PATCH";
    private const DELETE = "DELETE";
}