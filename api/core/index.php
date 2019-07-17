<?php
require 'Base.php';

class Courier extends Base {

  // database connection and table name
  private $conn,$table_name = "couriers";

  // object properties
  public $id, $company_name, $description, $location, $salary_range, $qualification, $working_hours, $age,
   $gender, $sector, $status,$_error , $created_at, $updated_at, $deleted_at, $company_id,$_count,$_result,$_lastInsertID;
  
   private $null  = null,$deleted_status = 2;
  public $active_status = 1,$not_active = 0;
  private $_fetchStyle = PDO::FETCH_CLASS;
  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
  }

  // read jobs
  function read()
  {

    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                WHERE package_status = :status
                ORDER BY created_at
                 DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":status", $this->active_status);


    // execute query
    $stmt->execute();

    return $stmt;
  }

  // create courier
  function create()
  {

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            admin_id=:admin_id,
            tracking_id=:tracking_id,
             shipper_first_name=:shipper_first_name,shipper_last_name=:shipper_last_name,shipper_address=:shipper_address,shipper_country=:shipper_country,
              shipper_number=:shipper_number, created_at=:created_at,shipper_email=:shipper_email,receiver_first_name=:receiver_first_name,
              receiver_last_name=:receiver_last_name,receiver_address=:receiver_address,receiver_number=:receiver_number,
                package_status=:package_status,receiver_email=:receiver_email,receiver_country=:receiver_country";

    // prepare query
    $stmt = $this->conn->prepare($query);
    $shipper_first_name = time().uniqid();
    // sanitize
    $this->shipper_last_name = htmlspecialchars(strip_tags($this->shipper_last_name));
    $this->shipper_country = htmlspecialchars(strip_tags($this->shipper_country));
    $this->shipper_number = htmlspecialchars(strip_tags($this->shipper_number));
    $this->created_at = htmlspecialchars(strip_tags($this->created_at));
    $this->shipper_address = htmlspecialchars(strip_tags($this->shipper_address));

    $this->shipper_email = htmlspecialchars(strip_tags($this->shipper_email));
    $this->receiver_number = htmlspecialchars(strip_tags($this->receiver_number));
    $this->receiver_address = htmlspecialchars(strip_tags($this->receiver_address));
    $this->package_status = 1;
    $this->receiver_first_name = htmlspecialchars(strip_tags($this->receiver_first_name));
    $this->receiver_last_name = htmlspecialchars(strip_tags($this->receiver_last_name));
    $this->receiver_email = htmlspecialchars(strip_tags($this->receiver_email));
    $this->receiver_country = htmlspecialchars(strip_tags($this->receiver_country));
    // bind values
    $stmt->bindParam(":shipper_last_name", $this->shipper_last_name);
    $stmt->bindParam(":shipper_first_name", $this->shipper_first_name);
    $stmt->bindParam(":shipper_country", $this->shipper_country);
    $stmt->bindParam(":shipper_number", $this->shipper_number);
    $stmt->bindParam(":created_at", $this->created_at);
    $stmt->bindParam(":shipper_address", $this->shipper_address);
    $stmt->bindParam(":receiver_number", $this->receiver_number);
    $stmt->bindParam(":shipper_email", $this->shipper_email);
    $stmt->bindParam(":receiver_address", $this->receiver_address);
    $stmt->bindParam(":receiver_first_name", $this->receiver_first_name);
    $stmt->bindParam(":package_status", $this->package_status);
    $stmt->bindParam(":receiver_last_name", $this->receiver_last_name);
    $stmt->bindParam(":receiver_email", $this->receiver_email);
    $stmt->bindParam(":receiver_country", $this->receiver_country);
    $stmt->bindParam(":tracking_id",$this->tracking_id);
    $admin_id = $_SESSION['admin_id'];
    $stmt->bindParam(":admin_id",$admin_id);

    // execute query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  // used when filling up the update job form
  function readOne(){
    // query to read single record
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
            WHERE
                tracking_id = ? AND status = ?
            LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of job to be updated
    $stmt->bindParam(1, $this->id);
    $stmt->bindParam(2,$this->active_status);


    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    extract($row[0]);
    // set values to object properties
    $this->salary_range = $salary_range;
    $this->description = $description;
    $this->company_id = $company_id;
    $this->age = $age;
    $this->qualification = $qualification;
    $this->gender = $gender;
    $this->title = $title;
    $this->location = $location;
    $this->education = $education;
    $this->experience_level = $experience_level; 
    $this->education = $education; 
    $this->company_email = $email;
    $this->phone = $phone1;

  }


  //check if row can be worked on
  public function is_workable(){
    $_query = "SELECT * FROM ".$this->table_name."
                         WHERE job_id = :id AND status = :status";
  $stmt =   $this->conn->prepare($_query);
    $stmt->bindParam(':id',$this->id);
    $stmt->bindParam(':status', $this->active_status);

    $stmt->execute();
    $this->_count = $num =  $stmt->rowCount();
    $this->_result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($this->_count < 0){
      $this->_error = true;
      return false;
    }else{
      return $num;
    }
  }

// add package info after adding shipper nd receiver info
  public function addPackageInfo(){

    
    // update query
    $query = "UPDATE
                " . $this->table_name . "
                SET
                no_of_pakages=:no_of_pakages,
                package_destination=:package_destination,
                comments=:comments,
                package_carrier=:package_carrier,
                package_weight=:package_weight,
                shipment_mode=:shipment_mode,
                updated_at=:updated_at,
                items_specified=:items_specified,
                payment_mode=:payment_mode,
                departure_time=:departure_time,
                departure_date=:departure_date,
                pick_up_date=:pick_up_date,
                pick_up_time=:pick_up_time,
                expected_delivery_date=:expected_delivery_date,
                package_reference_no=:package_reference_no
                
                 WHERE
                tracking_id =:tracking_id AND package_status =:status";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->no_of_pakages = htmlspecialchars(strip_tags($this->no_of_pakages));
    $this->package_destination = htmlspecialchars(strip_tags($this->package_destination));
    $this->comments = htmlspecialchars(strip_tags($this->comments)); 
    $this->package_carrier = htmlspecialchars(strip_tags($this->package_carrier));
    $this->package_weight = htmlspecialchars(strip_tags($this->package_weight));
    $this->tracking_id = htmlspecialchars(strip_tags($this->tracking_id));
    $this->status = 1;
  
  
    $this->shipment_mode = htmlspecialchars(strip_tags($this->shipment_mode)); 
    $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
    $this->items_specified = htmlspecialchars(strip_tags($this->items_specified));
    $this->payment_mode = htmlspecialchars(strip_tags($this->payment_mode));
    $this->departure_time = htmlspecialchars(strip_tags($this->departure_time));
    $this->departure_date = htmlspecialchars(strip_tags($this->departure_date));

    $this->pick_up_date = htmlspecialchars(strip_tags($this->pick_up_date));
    $this->pick_up_time =htmlspecialchars(strip_tags($this->pick_up_time));
    $this->expected_delivery_date = htmlspecialchars(strip_tags($this->expected_delivery_date));
    $this->package_reference_no = time().uniqid();

    // bind new values
    $stmt->bindParam(':no_of_pakages', $this->no_of_pakages);
    $stmt->bindParam(':package_destination', $this->package_destination);
    $stmt->bindParam(':package_carrier', $this->package_carrier);
    $stmt->bindParam(':package_weight', $this->package_weight);
    $stmt->bindParam(':comments',$this->comments);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':tracking_id', $this->tracking_id);


    $stmt->bindParam(':payment_mode', $this->payment_mode);
    $stmt->bindParam(':departure_time', $this->departure_time);
    $stmt->bindParam(':shipment_mode', $this->shipment_mode);
    $stmt->bindParam(':updated_at', $this->updated_at);
    $stmt->bindParam(':items_specified', $this->items_specified);
    $stmt->bindParam(':departure_date',$this->departure_date);

    $stmt->bindParam(':pick_up_date', $this->pick_up_date);
    $stmt->bindParam(':pick_up_time', $this->pick_up_time);
    $stmt->bindParam(':expected_delivery_date',$this->expected_delivery_date);
    $stmt->bindParam(':package_reference_no',$this->package_reference_no);
    // execute the query
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
    $this->_result =  null;
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

  // update the courier
  function update()
  {


    // update query
    $query =    "UPDATE
                " . $this->table_name . "
                SET
                
                

                receiver_first_name=:receiver_first_name,
                receiver_last_name=:receiver_last_name,
                receiver_address=:receiver_address,
                receiver_number=:receiver_number,
                receiver_email=:receiver_email,
                receiver_country=:receiver_country,


                shipper_last_name=:shipper_last_name,
                shipper_first_name=:shipper_first_name,
                shipper_country=:shipper_country,
                shipper_number=:shipper_number,
                shipper_address=:shipper_address,
                shipper_email=:shipper_email,

                no_of_pakages=:no_of_pakages,
                package_destination=:package_destination,
                package_weight=:package_weight,
                shipment_mode=:shipment_mode,
                updated_at=:updated_at,
                items_specified=:items_specified,
                payment_mode=:payment_mode,

                departure_time=:departure_time,
                pick_up_date=:pick_up_date,
                pick_up_time=:pick_up_time,
                comments=:comments,
                departure_date=:departure_date,
                expected_delivery_date=:expected_delivery_date

  
                 WHERE
                tracking_id =:tracking_id AND package_status = :status";

    

    // sanitize
    $this->no_of_pakages = htmlspecialchars(strip_tags($this->no_of_pakages));
    $this->package_destination = htmlspecialchars(strip_tags($this->package_destination));
    $this->package_weight = htmlspecialchars(strip_tags($this->package_weight));
    $this->shipment_mode = htmlspecialchars(strip_tags($this->shipment_mode));
    $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
    $this->items_specified = htmlspecialchars(strip_tags($this->items_specified));
    $this->payment_mode = htmlspecialchars(strip_tags($this->payment_mode));
    
    $this->departure_time = htmlspecialchars(strip_tags($this->departure_time));
    $this->pick_up_date = htmlspecialchars(strip_tags($this->pick_up_date));
    $this->tracking_id = htmlspecialchars(strip_tags($this->tracking_id));
    $this->pick_up_time =htmlspecialchars(strip_tags($this->pick_up_time));
    $this->comments = htmlspecialchars(strip_tags($this->comments));
    $this->departure_date = htmlspecialchars(strip_tags($this->departure_date));
    $this->expected_delivery_date = htmlspecialchars(strip_tags($this->expected_delivery_date));
    
    $this->shipper_last_name = htmlspecialchars(strip_tags($this->shipper_last_name));
    $this->shipper_first_name = htmlspecialchars(strip_tags($this->shipper_first_name));
    $this->shipper_country = htmlspecialchars(strip_tags($this->shipper_country));
    $this->shipper_number = htmlspecialchars(strip_tags($this->shipper_number));
    $this->shipper_address = htmlspecialchars(strip_tags($this->shipper_address));
    $this->shipper_email = htmlspecialchars(strip_tags($this->shipper_email));

    $this->receiver_number = htmlspecialchars(strip_tags($this->receiver_number));
    $this->receiver_address = htmlspecialchars(strip_tags($this->receiver_address));
    $this->receiver_first_name = htmlspecialchars(strip_tags($this->receiver_first_name));
    $this->receiver_last_name = htmlspecialchars(strip_tags($this->receiver_last_name));
    $this->receiver_email = htmlspecialchars(strip_tags($this->receiver_email));
    $this->receiver_country = htmlspecialchars(strip_tags($this->receiver_country));
    $this->status = 1;


// prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind new values
    $stmt->bindParam(':no_of_pakages', $this->no_of_pakages);
    $stmt->bindParam(':package_destination', $this->package_destination);
    $stmt->bindParam(':package_weight', $this->package_weight);
    $stmt->bindParam(':payment_mode', $this->payment_mode);
    $stmt->bindParam(':pick_up_date', $this->pick_up_date);
    $stmt->bindParam(':pick_up_time', $this->pick_up_time);

    $stmt->bindParam(':departure_time', $this->departure_time);
    $stmt->bindParam(':shipment_mode', $this->shipment_mode);
    $stmt->bindParam(':updated_at', $this->updated_at);
    $stmt->bindParam(':items_specified', $this->items_specified);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':tracking_id', $this->tracking_id);
    $stmt->bindParam(':departure_date',$this->departure_date);
    $stmt->bindParam(':comments',$this->comments);
    $stmt->bindParam(':expected_delivery_date',$this->expected_delivery_date);
    
    $stmt->bindParam(":shipper_last_name", $this->shipper_last_name);
    $stmt->bindParam(":shipper_first_name", $this->shipper_first_name);
    $stmt->bindParam(":shipper_country", $this->shipper_country);
    $stmt->bindParam(":shipper_number", $this->shipper_number);
    $stmt->bindParam(":shipper_address", $this->shipper_address);
    $stmt->bindParam(":shipper_email", $this->shipper_email);

    $stmt->bindParam(":receiver_address", $this->receiver_address);
    $stmt->bindParam(":receiver_first_name", $this->receiver_first_name);
    $stmt->bindParam(":receiver_number", $this->receiver_number);
    $stmt->bindParam(":receiver_last_name", $this->receiver_last_name);
    $stmt->bindParam(":receiver_email", $this->receiver_email);
    $stmt->bindParam(":receiver_country", $this->receiver_country);

    // execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  // delete the courier
  function delete($tracking_id)
  {
    // delete query
    $query = "UPDATE $this->table_name
    SET package_status =:package_status,
    deleted_at =:deleted_at
    WHERE tracking_id =:tracking_id";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id = htmlspecialchars(strip_tags($tracking_id));
    $this->deleted_at = date('Y-m-d H:i:s');
    // bind id of record to delete
    $stmt->bindParam("package_status", $this->not_active);
    $stmt->bindParam("deleted_at", $this->deleted_at);
    $stmt->bindParam("tracking_id", $this->id);

    // execute query
    if ($stmt->execute()) {
      return $stmt;
    }

    return false;
  }

  // search products
  function search($tracking_id)
  {

    // select all query
    $query = "SELECT *
            FROM
                " . $this->table_name . "
            WHERE
            tracking_id = ? AND package_status = ?";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $tracking_id = htmlspecialchars(strip_tags($tracking_id));
    
    // bind
    $stmt->bindParam(1, $tracking_id);
    $stmt->bindParam(2, $this->active_status);


    // execute query
    if($stmt->execute()){
        return $stmt;  
    }

  }

  // read jobs with pagination
  public function readPaging($from_record_num, $records_per_page)
  {

    // select query
    $query = "SELECT
            *
            FROM
                " . $this->table_name . "
                WHERE status = ?
            ORDER BY created_at DESC
            LIMIT ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind variable values
    $stmt->bindParam(1, $this->active_status);
    $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
  }

  public function count()
  {
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }

}
