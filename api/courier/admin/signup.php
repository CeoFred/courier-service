<?php
session_start();

/**
 * Here we want to register a new admin
 */

 // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('HEY NIGGA!! SEND THE RIGHT REQUEST TYPE');
}

// include database and object file
include_once '../../config/db.php';
include_once '../../core/admin.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare job object
$admin = new Admin($db);

// get admin_i

$first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
$last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;


if($first_name === null || $first_name === null || $last_name ===   null || $password === null){
        http_response_code(403);
        echo $admin->forbidden('You cannot go any furthe,details are incomplete');
        return;
}

$admin->first_name =  $first_name;
$admin->last_name = $last_name;
$admin->email = $email;
$admin->password = $password;


$admin->query("SELECT email FROM $admin->table_name WHERE email =? ",[$email]);

if($admin->_result){
    
    echo $admin->actionFailure('Email already in use');
    return;
}

 try {

     $admin->register();
     http_response_code(201);

     echo $admin->actionSuccess('Account created successfully');
     return;

 } catch (\Throwable $th) {
    http_response_code(505);

        echo $admin->actionFailure('Opps! Something went wrong, error code xm112c3 '. $th->getMessage()); 
        die;
}

