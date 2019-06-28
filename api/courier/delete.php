<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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

// get job id
$data = json_decode(file_get_contents("php://input"));

// set job id to be deleted
$job->id = $data->job_id;




try {
    
    $job->delete();
    // set response code - 200 ok
    http_response_code(201);

    // tell the user
    echo $job->actionSuccess('Job was deleted successfully');

} catch (\Throwable $th) {
    
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo $job->forbidden("Unable to delete job.".$th->getMessage());
}

?>