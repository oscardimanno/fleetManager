<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/config.php';
global $mysql;


if (_ENV === "dev") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
    $whoops->register();
}


/*
 * TODO:
 * 1) autenticazione
 * 2) sessioni
 * 3) permessi
 * 4) cronjob
 * 5) mail
 * 6) log
 * 7) template
 * 8) form
 * 9) validation
 * 10) query builder
 * 11) test
 */

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

$router->run();