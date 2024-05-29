<?php

namespace kernel;

use PDO;

class DB extends PDO
{
    public function __construct() 
    {
        $host = $_SERVER['MYSQL_HOST'];
        $dbName = $_SERVER['MYSQL_DATABASE'];
        $user = $_SERVER['MYSQL_USER'];
        $password = $_SERVER['MYSQL_PASSWORD'];

        parent::__construct("mysql:host={$host};port=3306;dbname={$dbName}", $user, $password);
    }
}