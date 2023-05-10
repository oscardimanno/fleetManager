<?php

namespace App\classes;

use App\middleware\define\MiddlewareChain;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class router
{

    protected $map;


    public $middleware = [];

    public function __construct()
    {
        $this->map = [
            "GET" => [],
            "POST" => [],
            "PUT" => [],
            "DELETE" => []
        ];
    }

    public function get($path, $controller)
    {
        $this->map["GET"][$path] = $controller;
    }

    public function post($path, $controller)
    {
        $this->map["POST"][$path] = $controller;
    }

    public function put($path, $controller)
    {
        $this->map["PUT"][$path] = $controller;
    }

    public function delete($path, $controller)
    {
        $this->map["DELETE"][$path] = $controller;
    }

    public function run()
    {

        $request = Request::createFromGlobals();
        $response = new Response();

        $method = $request->getMethod();
        $path = $request->getRequestUri() ?? "/";
        $controller = $this->map[$method][$path] ?? null;

//        //Todo: implementare il parsing dei parametri
//        preg_match_all('/\{([^\}]*)\}/', $path, $matches);
//        $matches = $matches[1];
//        $data = [];
//        foreach ($matches as $match) {
//            $data[$match] = $request->get($match);
//        }
//
//        $controller = $controller ? function () use ($controller, $data) {
//            return $controller($data);
//        } : null;


        //Implementa la chiamata al middleware
        //foreach($this->middleware as $key => $middleware){
        //    $response = $middleware($request, $this->middleware[$key+1] ?? null, $this->middleware[$key+2] ?? null);
        //}

        //if (!$controller) {
        //    die;
        //}

        $middlewareChain = new MiddlewareChain();

        $middlewareChain->addMiddleware(new \App\middleware\LoggerMiddleware());
        $middlewareChain->addMiddleware(new \App\middleware\AuthMiddleware());
        $middlewareChain->addMiddleware(new \App\middleware\CacheMiddleware());
        $request = $middlewareChain->handleRequest($request);
        if ($request) {
            $controllerRes = call_user_func($controller);
            $response->setContent($controllerRes);
            $response = $middlewareChain->handleResponse($response);
            if ($response) {
                $response->send();
            } else {
                return false;
            }
        } else {
            return false;
        }
        return false;
    }
}