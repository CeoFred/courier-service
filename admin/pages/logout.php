<?php

session_start();

$_SESSION['codemon_authenticated'] = false;
session_destroy();

header('Location:login.php');
die();