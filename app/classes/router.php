<?php

namespace App\classes;
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
        foreach($this->middleware as $middleware){
            list($request, $response) = $middleware($request, $response);
        }

        if(!$controller){
            die;
        }

        return call_user_func($controller);
    }
}