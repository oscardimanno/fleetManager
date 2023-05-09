<?php

namespace App\classes\abstract;
use App\classes\mysql;
use PDO;


/**
 * Class Model
 * @package App\classes\abstract
 * @author Oscar Di Manno <oscar.dimanno1@gmail.com>
 */
abstract class Model {
    protected $table; //Archivia la tabella su cui lavorare
    protected $dataset = []; //Contiene i dati del record


    public function __construct() {

    }

    /**
     * Metodo magico per ottenere e settare i dati del record
     * @param string $name
     * @param array $arguments
     * @return mixed|null
     */
    public function __call(string $name, array $arguments)
    {
        if (str_starts_with($name, 'get')) {
            $key = strtolower(substr($name, 3));
            if(in_array($key, array_keys($this->dataset))){
                return $this->dataset[$key];
            }else{
                return null;
            }
        }
        if (str_starts_with($name, 'set')) {
            $key = strtolower(substr($name, 3));
                $this->dataset[$key] = $arguments[0];
                return true;
        }
        return null;
    }


    /**
     * Metodo per ottenere tutti i record della tabella - WIP
     * @return array|false
     */
    public function all() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Metodo per ottenere un record della tabella
     * @param $id
     * @return $this|null
     */
    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result) {
            $this->dataset = $result;
            return $this;
        }else{
            return null;
        }
    }

    /**
     * Metodo per creare un record della tabella
     * @param $data array Vettore associativo con i dati da inserire
     * @return $this|null
     */
    public function create($data = []) {

        if(empty($data)){
            $data = $this->dataset;
        }
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $stmt = mysql::getIstanza()->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();
        $data['id'] = mysql::getIstanza()->lastInsertId();
        $this->dataset = $data;
        return $data['id'];
    }

    /**
     * Metodo per aggiornare un record della tabella
     * @param $data array Vettore associativo con i dati da inserire
     * @return bool
     */
    public function update($data = []) {

        if(empty($data)){
            $data = $this->dataset;
        }

        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "{$key} = :{$key}";
        }
        $set = implode(', ', $set);
        $query = "UPDATE {$this->table} SET {$set} WHERE id = :id";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        return $stmt->execute();
    }

    /**
     * Metodo per eliminare un record dalla tabella in base all'ID
     * @param $data
     * @return bool
     */
    public function delete($data = []) {
        if(empty($data)){
            $data = $this->dataset;
        }
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        return $stmt->execute();
    }
}