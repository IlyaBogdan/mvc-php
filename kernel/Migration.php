<?php 

namespace kernel;

use PDO;

abstract class Migration
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . getenv('MYSQL_HOST') . ";dbname=" . getenv('MYSQL_DATABASE'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    }

    public function __destruct()
    {
        
    }

    abstract function up(): void;
    abstract function down(): void;

    protected function exec(string $sqlInstruction): void 
    {
        $this->db->exec($sqlInstruction);
    }
}