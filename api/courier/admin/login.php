<?php
session_start();

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

// prepare admin object
$admin = new Admin($db);


$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

if($email === null || $password === null){
   
        echo $admin->forbidden('Email or password was left empty');
        return;
}

/**
 * More security measures should be implemented for now skipping it
 */

 try {
   
   $admin->query("SELECT *
     FROM admin WHERE email = ?",[$email]);

    if($admin->_result){
        $pass = $admin->_result[0]->password;
     $valid =   password_verify($password,$pass) ? 1 : 0;
     if($valid){
        $admin->_result[0]->password= null;
        $_SESSION['admin_id'] = $admin->_result[0]->admin_id;
        $_SESSION['codemon_authenticated'] =  true;
        $_SESSION['first_name'] = $admin->_result[0]->first_name;
    echo  $admin->actionSuccess(['data' => $admin->_result]);
    return;
     }else{
    echo  $admin->actionFailure('Email and password does not match');
        return;
     }
    }

 } catch (\Throwable $th) {
        echo $admin->actionFailure('Opps! Something went wrong, error code xm112c3'. $th->getMessage()); 
        die;
    }

