<?php

namespace App\middleware;

use App\middleware\define\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface {
    public function handleRequest(\Symfony\Component\HttpFoundation\Request $request) {
        // check if user is authenticated
        $auth = true;
        if($auth){
            return $request;
        }else{
            return false;
        }
    }

    public function handleResponse(\Symfony\Component\HttpFoundation\Response $response) {
        // do nothing
        return $response;
    }
}