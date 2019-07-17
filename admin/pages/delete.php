<?php
session_start();

$tracking_id = isset($_GET['tracking_id']) ? $_GET['tracking_id'] : null;
$admin = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if(is_null($admin)){
    header('Location: login.php');
    die();
}
// get database connection
include_once '../../api/config/db.php';

// instantiate courier object
include_once '../../api/core/index.php';

$database = new Database();
$db = $database->getConnection();

$courier = new Courier($db);

$query = $courier->delete($tracking_id);

$res = $query;


var_dump($res);

if($res){
    echo 'Deleted Courier with tracking id = '.$tracking_id.' please wait while we redirect you..';

    header('Location: all.php?deleted=true&tracking_id='.$tracking_id.'');
    $_SESSION['c_deleted'] = $tracking_id;
    die();
}else {
    
    echo 'Failed to delete Courier with tracking id = '.$tracking_id;
    // sleep(3);

    header('Location: all.php?deleted=false&tracking_id='.$tracking_id.'');
    $_SESSION['c_deleted_false'] = $tracking_id;
    die();
}
