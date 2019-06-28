<?php

require 'Base.php';

class Admin extends Base {

  // database connection and table name
  public $conn,$table_name = "admin", $null  = null,$deleted_status = 2,$active_status = 1,$not_active = 0,$_result = null;
  private $_fetchStyle = PDO::FETCH_CLASS;

  // constructor with $db as database connection
  public function __construct($db){

    $this->conn = $db;
  
    }


  // create courier
  function register(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            admin_id=:admin_id,first_name=:first_name,last_name=:last_name,email=:email,
            created_at=:created_at,password=:password
             ";
    // prepare query
    $stmt = $this->conn->prepare($query);
    $admin_id = time().uniqid();
    // sanitize
    $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->created_at = date('Y-m-d H:i:s');
    $this->password = password_hash(htmlspecialchars(strip_tags($this->password)),PASSWORD_BCRYPT);

    $this->admin_id = rand(3,34).time();
    // bind values
     $stmt->bindParam(":first_name", $this->first_name);
     $stmt->bindParam(":last_name", $this->last_name);
     $stmt->bindParam(":email", $this->email);
   $stmt->bindParam(":created_at", $this->created_at);
    $stmt->bindParam(":admin_id",$admin_id);
   $stmt->bindParam(":password",$this->password);

    // execute query
    if ($stmt->execute()) {

      return true;
    }

    return false;
  }

    /**
   * Perform raw query
   */
  public function query($sql, $params = [],$class = false,$fetch = true) {
    $this->_error = false;
    if($this->_query = $this->conn->prepare($sql)) {
      $x = 1;
      if(count($params)) {
        foreach($params as $param) {
          $this->_query->bindValue($x, $param);
          $x++;
        }
      }
      if($this->_query->execute()) {

        if($fetch){
          if($class && $this->_fetchStyle === PDO::FETCH_CLASS){
            $this->_result = $this->_query->fetchAll($this->_fetchStyle,$class);
          } else {
            $this->_result = $this->_query->fetchAll($this->_fetchStyle);
          }
          
        $this->_count = $this->_query->rowCount();
        $this->_lastInsertID = $this->conn->lastInsertId();
          }
        
      } else {
        $this->_error = true;
      }
    }
    return $this;
  }


    
}
