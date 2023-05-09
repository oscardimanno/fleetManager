<?php

namespace App\middleware;

class AuthMiddleware
{
    public function handle($request, $response)
    {
        if (!isset($_SESSION["user"])) {
            header("Location: /login");
            exit;
        }
    }
}