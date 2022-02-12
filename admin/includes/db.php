<?php
require_once("config.php");

class Database {
    public $conn;
    
    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if($this->conn->connect_errno)
            die('Failed to connect database. ') . $this->conn->connect_error;
    }
    
    public function query_db($sql) {
        $res = $this->conn->query($sql);
        if(!$res)
            die("Query failed. " . $this->conn->error);
        
        return $res;
    }
    
    public function escape($str) { return $this->conn->real_escape_string(trim($str));}
    public function get_insert_id() { return $this->conn->insert_id;}
    public function get_affected_rows() { return $this->conn->affected_rows;}
}

$db = new Database();
?>