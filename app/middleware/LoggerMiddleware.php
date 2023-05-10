<?php

namespace App\middleware;

use App\middleware\define\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoggerMiddleware implements MiddlewareInterface {
    public function handleRequest(Request $request) {
        // log request

        return $request;
    }

    public function handleResponse(Response $response) {
        // log response

        return $response;
    }
}