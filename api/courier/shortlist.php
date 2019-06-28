<?php

/**
 * 
 * Code to shortlist a candidate
 * 
 */
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD']  != 'POST'){
    die('Use the right method bro');
}
// include database and object file
include_once '../config/db.php';
include_once '../core/index.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$job = new job($db);

// set job id to be deleted
$job->company_id = $_REQUEST['company_id'];
$job->id = $_REQUEST['job_id'];
$user = $_REQUEST['user_id'];

if(!$job->is_workable()){
    echo $job->forbidden('Job is not Avialable');
    die;
} 

$job->query("SELECT * FROM job_applications WHERE
 user_id=? AND company_id=? AND job_id=? AND is_shortlisted=?",[$user,$job->company_id,$job->id,$job->not_active],false,true);

if(empty($job->_count)){
    
    echo $job->actionFailure('User has already been shortlisted');
    return;
}

try{
    $sc_id =  time().uniqid('sc',true);
    $job->query("INSERT INTO jobs_shortlisted_candidates 
    SET company_id = ?,sc_id = ?,job_id =?,user_id = ?",
     [$job->company_id,$sc_id,$job->id,$user],false,false);

}catch(\Throwable $er){
    echo $job->actionFailure('Opps! Something went wrong '.$er->getMessage(). $er->getLine(). $er);
    return;

}catch(\Exception $exec){
    echo $job->actionFailure('Opps! Something went wrong an exception '.$exec->getMessage());
    return;
}

// update row on job_application

$job->_result = '';
$job->_count = '';
try {
 
$job->query("UPDATE job_applications SET is_shortlisted = ? WHERE
user_id = ? AND company_id = ? AND job_id = ? AND is_shortlisted = ? ",[$job->active_status,$user,$job->company_id,$job->id,$job->not_active],true,false);

echo $job->actionSuccess('User has been shortlisted successfully');
return;

} catch (\Throwable $th) {
    echo $job->actionFailure('Opps! Something went wrong While updating table '.$th->getMessage());
    return;
}




