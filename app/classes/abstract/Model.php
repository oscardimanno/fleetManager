<?php

namespace App\classes\abstract;
use App\classes\mysql;
use PDO;

abstract class Model {
    protected $table;

    public function __construct() {

    }

    // Metodo per ottenere tutti i record della tabella
    public function all() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodo per ottenere un singolo record della tabella in base all'ID
    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Metodo per aggiungere un nuovo record alla tabella
    public function create($data) {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $stmt = mysql::getIstanza()->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();
        return mysql::getIstanza()->lastInsertId();
    }

    // Metodo per aggiornare un record esistente nella tabella
    public function update($id, $data) {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "{$key} = :{$key}";
        }
        $set = implode(', ', $set);
        $query = "UPDATE {$this->table} SET {$set} WHERE id = :id";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        return $stmt->execute();
    }

    // Metodo per eliminare un record dalla tabella in base all'ID
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = mysql::getIstanza()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}