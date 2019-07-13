<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/db.php';

// instantiate courier object
include_once '../core/index.php';

$database = new Database();
$db = $database->getConnection();

$courier = new Courier($db);
function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

// var_dump($_REQUEST);
// die();
// make sure data is not empty
if(
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

    // set courier property values
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

    $courier->created_at = date('Y-m-d H:i:s');
    $courier->tracking_id = randomNumber(12);      

    // create the courier 
    if($courier->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo $courier->Success(['msg' => 'courier created successfully','t_id' => $courier->tracking_id ]);
    }

    // if unable to create the courier, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo $courier->forbidden('Opps! Something went wrong');
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(409);

    // tell the user
   echo $courier->actionFailure('Unable to create courier. Data is incomplete.');
}
?>