<?php

namespace App\middleware\define;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface MiddlewareInterface {
    public function handleRequest(Request $request);
    public function handleResponse(Response $response);
}