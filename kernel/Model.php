<?php 

namespace kernel;

use PDO;

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=mydb', 'username', 'password');
    }
}