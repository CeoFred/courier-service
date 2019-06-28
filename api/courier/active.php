<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$job = new job($db);

$company_id = $_REQUEST['company_id'];

try {
$job->query("SELECT company_id FROM jobs WHERE company_id = ? AND status = ?",[$company_id,$job->active_status]);
    $num  =  count($job->_result);

    echo $job->actionSuccess(['data' => $num]);
    return;
} catch (\Throwable $th) {
    echo $job->forbidden($th->getMessage()); 
    return;
}





