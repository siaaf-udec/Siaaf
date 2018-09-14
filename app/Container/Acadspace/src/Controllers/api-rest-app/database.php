<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name;
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection($db_name){

        $this->conn = null;
        $this->db_name = $db_name;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=".$this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
