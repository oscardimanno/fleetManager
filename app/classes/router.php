<?php

namespace App\classes;

class router
{

    protected $map;

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

    public function resolve()
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $path = $_SERVER["PATH_INFO"] ?? "/";
        $controller = $this->map[$method][$path] ?? null;
        if(!$controller){
            echo "Page not found";
            exit;
        }
        echo call_user_func($controller);
    }
}