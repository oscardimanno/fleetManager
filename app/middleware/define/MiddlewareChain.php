<?php

namespace App\middleware\define;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareChain
{
    private $middlewareList;

    public function __construct()
    {
        $this->middlewareList = array();
    }

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewareList[] = $middleware;
    }

    public function handleRequest(Request $request): Request
    {
        foreach ($this->middlewareList as $middleware) {
            $request = $middleware->handleRequest($request);
        }
        return $request;
    }

    public function handleResponse(Response $response): Response
    {
        foreach (array_reverse($this->middlewareList) as $middleware) {
            if($response->getStatusCode() != 200){
                break;
            }else{
                $response = $middleware->handleResponse($response);
            }
        }
        return $response;
    }
}