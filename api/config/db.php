<?php
class Database{

    // heroku credentials
//     private $host = "us-cdbr-east-06.cleardb.net";
//     private $db_name = "heroku_cfa038a59a6920c";
//     private $username = "b8e93990aa4e63";
//     private $password = "8d33f7af ";
    
$url = parse_url("mysql://b8e93990aa4e63:8d33f7af@us-cdbr-east-06.cleardb.net/heroku_cfa038a59a6920c?reconnect=true");
private $host = $url["host"];
private $username = $url["user"];
private $password = $url["pass"];
private $db_name = substr($url["path"], 1);
    
    //local host crednetials
//     private $host = "localhost";
//     private $db_name = "courier";
//     private $username = "root";
//     private $password = "";
   
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
