<?php
/**
 * 
 * Here we get all applicants for a particular job
 */

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    die('HEY NIGGA!! SEND THE RIGHT REQUEST TYPE');
}

// include database and object file
include_once '../../config/db.php';
include_once '../../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$job = new job($db);

// get job_i

$job->id = isset($_REQUEST['job_id']) ? $_REQUEST['job_id'] : null;
$company_id = isset($_REQUEST['company_id']) ? $_REQUEST['company_id'] : null;
/**
 * We want to verify that only authenticated users can proceed so we need a token,else we use the user_id
 */
$userToken = isset($_REQUEST['token']) ? true : null;

if($userToken == null){
    $user_id = $_REQUEST['user_id'] ? $_REQUEST['user_id'] : null;
/**
 * One of user_id or token should be provided
 */
    if($user_id == null){
        echo $job->forbidden('You cannot go any further');
        die;
    }
}

/**
 * More security measures should be implemented for now skipping it
 */

 try {
    $job->query("SELECT *
     FROM job_applications
     INNER JOIN users ON job_applications.user_id = users.userid WHERE job_id = ? AND company_id = ?",[$job->id,$company_id]);
    echo  $job->actionSuccess(['data' => $job->_result]);
    return;     
 } catch (\Throwable $th) {
        echo $job->actionFailure('Opps! Something went wrong, error code xm112c3'. $th->getMessage()); 
        die;
    }

