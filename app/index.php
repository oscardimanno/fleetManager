<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/config.php';
global $mysql;


$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$mysql = new \App\classes\mysql();
$router = new \App\classes\router();

$router->get('/veicolo/crea', function ($data = []) {
    $Veicolo = new \App\models\Veicolo();
    $Veicolo->find(2);
    $Veicolo->setMarca("Fiat");
    $Veicolo->update();
});

$router->get('/get/{id}', function ($data = []) {
    $Veicolo = new \App\models\Veicolo();
    $Veicolo->find(2);
    $Veicolo->setMarca("Fiat");
    $Veicolo->update();
});

$router->middleware = [
    function ($request, $response) {
        $response->setContent("Middleware");
        return [$request, $response];
    },

    function ($request, $response) {
        if($response->getContent() == "Middleware"){
         $response->setContent($response->getContent()."<br>Middleware2");
        }
        return [$request, $response];
    },

    function ($request, $response) {
    $response->setContent($response->getContent().$request->getMethod() . $request->getRequestUri());
        $response->send();
        return [$request, $response];
    }
    ];

$router->run();
