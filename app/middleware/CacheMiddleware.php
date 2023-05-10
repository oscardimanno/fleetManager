<?php

namespace App\middleware;

use App\middleware\define\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheMiddleware implements MiddlewareInterface {
    public function handleRequest(Request $request) {
        // check cache for response

        return $request;
    }

    public function handleResponse(Response $response) {
        // store response in cache

        return $response;
    }
}