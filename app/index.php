<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/config.php';
global $mysql;
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$mysql = new \App\classes\mysql();


$router = new \App\classes\router();

$router->get('/test', function () {
    //TODO: implementare correttamente il router
    return "test";
});



$router->run();
