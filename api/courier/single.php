<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$job = new job($db);

// set ID property of record to read
$job->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of job to be edited
$job->readOne();

if($job->company_name!=null){
    // create array
    $job_arr = array(
        "id" =>  $job->id,
        "company_name" => $job->company_name,
        "description" => $job->description,
        "salary_range" => $job->salary_range,
        "company_id" => $job->company_id,
        "qualification" => $job->qualification

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo $job->success($job_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user job does not exist
    echo $job->notFound("job does not exist.");
}
