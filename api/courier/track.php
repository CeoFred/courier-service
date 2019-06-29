<?php


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/db.php';
include_once '../core/index.php';

// instantiate database and job object
$database = new Database();
$db = $database->getConnection();

// initialize object
$courier = new Courier($db);

// get tracking_id
$tracking_id = isset($_GET["tracking_id"]) ? $_GET["tracking_id"] : null;

if($tracking_id === null){

    $tracking_id = isset($_POST["tracking_id"]) ? $_POST["tracking_id"] : null;
    if(is_null($tracking_id)){
        
    echo $courier->actionFailure('Tracking ID is required');
    return;
    }
}
// query couriers
$stmt = $courier->search(trim($tracking_id));
$num = $stmt->rowCount();

// check if more than 0 record found

if($num>0){

    // couriers array
    $couriers_arr=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $courier_item=array($row);

        array_push($couriers_arr, $courier_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show jobs data
    echo $courier->success($couriers_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no jobs found
    echo $courier->notFound("No tracking id found.");
}
