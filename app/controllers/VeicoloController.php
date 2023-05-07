<?php

namespace App\controllers;
use App\classes\abstract\Controller;
use App\classes\abstract\Model;
use App\models\Veicolo;

class VeicoloController extends Controller
{
    public function __construct()
    {
        $this->model = new Veicolo();
        parent::__construct();
    }
}