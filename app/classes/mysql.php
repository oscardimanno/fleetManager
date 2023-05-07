<?php

namespace App\classes;

use PDO;

class mysql
{
    private static $conn;
    private $connection;
    public function __construct()
    {
        $this->connection = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASSWORD);
    }


    public static function getClass(): mysql
    {
        if (!self::$conn) {
            self::$conn = new mysql();
        }
        return self::$conn;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }


    public static function getIstanza(): PDO
    {
        return self::getClass()->getConnection();
    }
}

