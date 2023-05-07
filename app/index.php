<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/config.php';
global $mysql;
$mysql = new \App\classes\mysql();


$router = new \App\classes\router();

$router->get('/', function ($id) {
    //TODO: implementare correttamente il router
    $VeicoloController = new \App\controllers\VeicoloController();
    return $VeicoloController->show($id);
});