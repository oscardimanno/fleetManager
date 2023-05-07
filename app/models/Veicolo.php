<?php

namespace App\models;

use \App\classes\abstract\Model;
use \App\classes\mysql;

class Veicolo extends Model
{

    protected $table = "veicoli";

    public function __construct()
    {
        parent::__construct();
    }
}