<?php 

namespace kernel;

use PDO;

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=" . getenv('MYSQL_HOST') . ";dbname=" . getenv('MYSQL_DATABASE'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    }
}