<?php
// session_start();

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization, X-Requested-With");

// include database and object files
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


$courier = new Courier($db);

$tid = $_REQUEST['tracking_id'] ? $_REQUEST['tracking_id'] : null;

if(!$tid){
  echo $courier->forbidden('Tracking ID is required');
  return;
}

$courier->query("SELECT * FROM couriers WHERE tracking_id = ? AND package_status= ?",[$_REQUEST['tracking_id'],1]);

if(!$courier->_result){
  http_response_code(404);
  echo $courier->notFound('Tracking ID not found');
  return;
}


if(
  !empty($_REQUEST['no_of_pakages']) &&
  !empty($_REQUEST['package_destination']) &&
  !empty($_REQUEST['package_carrier']) &&
  !empty($_REQUEST['shipment_mode']) &&
  !empty($_REQUEST['package_weight']) &&
  !empty($_REQUEST['items_specified']) &&
  !empty($_REQUEST['payment_mode']) &&
  !empty($_REQUEST['expected_delivery_date']) &&
  !empty($_REQUEST['departure_time']) &&
  !empty($_REQUEST['pick_up_date']) &&
  !empty($_REQUEST['pick_up_time'])&&
  !empty($_REQUEST['comments']) &&
  !empty($_REQUEST['tracking_id']) &&
  !empty($_REQUEST['departure_date'])
){

  // set courier property values
  $courier->no_of_pakages = trim($_REQUEST['no_of_pakages']);
  $courier->package_destination = trim($_REQUEST['package_destination']);
  $courier->package_carrier = trim($_REQUEST['package_carrier']);
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
try {

    if($courier->addPackageInfo()){
         // set response code - 200 ok
     http_response_code(200);

     // tell the user
     echo $courier->actionSuccess("courier  was added and  updated. ");

     return;
    }

  
} catch (\Throwable $th) {
  
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $courier->forbidden("Unable to update courier. ".$th->getMessage());
    return;
}



  }else{

  // set response code - 400 bad request
  http_response_code(404);

  // tell the user
  echo $courier->notFound("Unable to create package, Data is incomplete.");

  }


