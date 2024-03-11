<?php


class Executor2 {
    private $conn;
    
    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function executeQuery($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute();
        return $stmt;
    }
}
