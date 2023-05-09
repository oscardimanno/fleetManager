<?php

namespace App\models;

use \App\classes\abstract\Model;
use \App\classes\mysql;


/**
 * Class Veicolo
 * @package App\models
 * @property int $id
 * @property string $marca
 * @property string $modello
 * @property int $cilindrata
 * @property int $cavalli
 * @method int getId()
 * @method string getMarca()
 * @method string getModello()
 * @method int getCilindrata()
 * @method int getCavalli()
 * @method bool setId(int $id)
 * @method bool setMarca(string $marca)
 * @method bool setModello(string $modello)
 * @method bool setCilindrata(int $cilindrata)
 * @method bool setCavalli(int $cavalli)
 */
class Veicolo extends Model
{

    protected $table = "veicoli";

    public function __construct()
    {
        parent::__construct();
    }
}