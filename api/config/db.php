<?php
class Database{

    // heroku credentials
    // private $host = "us-cdbr-iron-east-02.cleardb.net";
    // private $db_name = "heroku_2cc9f27b81c94e0";
    // private $username = "b16442e8aa5641";
    // private $password = "96654dd2";
    
    //local host crednetials
    private $host = "localhost";
    private $db_name = "courier";
    private $username = "root";
    private $password = "";
   
    // private $host = "localhost";
    // private $db_name = "fedexpos_courier";
    // private $username = "fedexpos_codemon";
    // private $password = "iftrueconnect";

    public $conn;
    
    

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(
        PDO::ATTR_PERSISTENT => true
      ));
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
            die();
        }

        return $this->conn;
    }
}
