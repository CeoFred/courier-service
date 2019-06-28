<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$courier = new Courier($db);


// echo json_encode($_REQUEST);
// return;
if(
  
  !empty($_REQUEST['no_of_pakages']) &&
  !empty($_REQUEST['package_destination']) &&
  !empty($_REQUEST['shipment_mode']) &&
  // !empty($_REQUEST['package_weight']) &&
  !empty(trim($_REQUEST['items_specified']))   &&
  !empty($_REQUEST['payment_mode']) &&
  !empty($_REQUEST['expected_delivery_date']) &&
  !empty($_REQUEST['departure_time']) &&
  !empty($_REQUEST['pick_up_date']) &&
  !empty($_REQUEST['pick_up_time'])&&
  !empty($_REQUEST['comments']) &&
  !empty($_REQUEST['tracking_id']) &&
  !empty($_REQUEST['departure_date']) &&
  !empty($_REQUEST['shipper_first_name']) &&
  !empty($_REQUEST['shipper_last_name']) &&
  !empty($_REQUEST['shipper_address']) &&
  !empty($_REQUEST['shipper_country']) &&
  !empty($_REQUEST['shipper_number']) &&
  !empty($_REQUEST['shipper_email']) &&
  !empty($_REQUEST['receiver_first_name']) &&
  !empty($_REQUEST['receiver_last_name']) &&
  !empty($_REQUEST['receiver_address']) &&
  !empty($_REQUEST['receiver_number']) &&
  !empty($_REQUEST['receiver_email'])&&
  !empty($_REQUEST['receiver_country'])


  ){

    $courier->no_of_pakages = trim($_REQUEST['no_of_pakages']);
  $courier->package_destination = trim($_REQUEST['package_destination']);
  $courier->package_weight = trim($_REQUEST['package_weight']);
  $courier->shipment_mode = trim($_REQUEST['shipment_mode']);
  $courier->items_specified = trim($_REQUEST['items_specified']);
  $courier->payment_mode = trim($_REQUEST['payment_mode']);
  $courier->expected_delivery_date = trim($_REQUEST['expected_delivery_date']);
  $courier->departure_time = trim($_REQUEST['departure_time']);
  $courier->pick_up_date = trim($_REQUEST['pick_up_date']);
  $courier->pick_up_time = trim($_REQUEST['pick_up_time']);
  $courier->comments = trim($_REQUEST['comments']);
  $courier->package_reference_no = uniqid().time();
  $courier->tracking_id = trim($_REQUEST['tracking_id']);
  $courier->updated_at = date('Y-m-d H:i:s');
  $courier->departure_date = trim($_REQUEST['departure_date']);
    $courier->shipper_first_name = trim($_REQUEST['shipper_first_name']);
    $courier->shipper_last_name = trim($_REQUEST['shipper_last_name']);
    $courier->shipper_address = trim($_REQUEST['shipper_address']);
    $courier->shipper_number = trim($_REQUEST['shipper_number']);
    $courier->shipper_country = trim($_REQUEST['shipper_country']);
    $courier->shipper_email = trim($_REQUEST['shipper_email']);
    $courier->receiver_first_name = trim($_REQUEST['receiver_first_name']);
    $courier->receiver_last_name = trim($_REQUEST['receiver_last_name']);
    $courier->receiver_address = trim($_REQUEST['receiver_address']);
    $courier->receiver_number = trim($_REQUEST['receiver_number']);
    $courier->receiver_email = trim($_REQUEST['receiver_email']);
    $courier->receiver_country = trim($_REQUEST['receiver_country']);

try {
  $courier->update();

     // set response code - 200 ok
     http_response_code(200);

     echo $courier->actionSuccess("Package was updated.");

     return;
  
} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $courier->forbidden("Unable to update courier. ".$th->getMessage());
    return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(400);

  // tell the user
  echo $courier->notFound("Unable to update Courier. Data is incomplete.");

  }


