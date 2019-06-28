<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die('HEY NIGGA!! SEND THE RIGHT REQUEST TYPE');
}

// include database and object file
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$job = new job($db);
$data = file_get_contents("php://input");

// set job id to be deleted
$job->company_id = isset($_POST['company_id']) ? $_POST['company_id'] : null;
$job->id = isset($_POST['job_id']) ? $_POST['job_id'] : null;
$user = isset($_POST['user_id']) ? $_POST['user_id'] : null;

/**
 * Let's check for the status of the job first
 *
 */
if (!$job->is_workable()) {
    echo $job->forbidden('This job is currently not available');
    return;
}
/**
 * Get user if exist
 */
$userFound = $job->query("SELECT * FROM users WHERE userid = ?", [$user],false,true);

/**
 * Catch error
 */
if (!$userFound) {
    echo $job->actionFailure('Opps! Something went wrong' . $job->error);
    return;
}

/**
  * Check if user has alredy applied for job
  */
  

  $job->query("SELECT id FROM job_applications WHERE user_id=? AND job_id= ? AND company_id = ?",[$user,$job->id,$job->company_id],false,true);

  if(!empty($job->_result)){
    echo $job->actionFailure('You cannot apply for this job a second time');
    return;
}

/**
 * Check if job belongs to company, we do a raw query
 */

$_query = "SELECT * FROM jobs
WHERE job_id = :id AND company_id = :companyid AND status = :status";
$stmt = $db->prepare($_query);
$stmt->bindParam(':id', $job->id);
$stmt->bindParam(':companyid', $job->company_id);
$stmt->bindParam(':status', $job->active_status);

$stmt->execute();

/**
 * Check for job - company error
 *
 */
if (!$stmt->execute() || $num = $stmt->rowCount() <= 0
) {
    echo $job->actionFailure('Opss! Something went wrong,job deos not belong to company');
    return;
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

// if ($cv['size'] > 300000) {
//     echo $job->forbidden('File size too large');
//     return;
// }

// $type = explode('/', $cv['type']);
// if ($type[1] != 'pdf') {
//     echo $job->forbidden('Only pdf file type is allowed');
//     return;
// }
// if ($cv['error']) {
//     echo $job->actionFailure('File could not be uploaede');
//     return;
// }
// $filename = time() . uniqid() . '.' . $type[1];

// $uploaded = move_uploaded_file($cv['tmp_name'], '../uploads/cv/' . $filename);

// if ($uploaded && !($cv['error'])) {
// add cv to table
//     $_query = "INSERT into job_application_cv
// SET cv_id = :cv_id , user_id = :userid, path = :path";
//     $cv_id = time().uniqid('cv',true);
//     $stmt = $db->prepare($_query);
//     $stmt->bindParam(':cv_id', $cv_id);
//     $stmt->bindParam(':userid', $user);
//     $stmt->bindParam(':path', $filename);

//     if(!$stmt->execute()){
//         echo $job->actionFailure('Opps! Table could not be updated');
//         return;
//     }

    $_query = "INSERT into job_applications
SET job_id=:job_id, user_id = :userid, is_shortlisted = :shortlisted,company_id = :company_id";
    $shorlisted = 0;
    $cv_id = time().uniqid('cv',true);
    $stmt = $db->prepare($_query);
    // $stmt->bindParam(':cv_id', $cv_id);
    $stmt->bindParam(':userid', $user);
    $stmt->bindParam(':job_id', $job->id);
    $stmt->bindParam(':shortlisted', $shorlisted);
    $stmt->bindParam(':company_id', $job->company_id);

try{
    $stmt->execute();
    echo $job->actionSuccess('Application was successful');
    return;
}catch(\Throwable $err) {
    echo $job->actionFailure('Opps! Table {job_applications} could not be updated' . $err->getMessage());
    return;    
}

    // }

