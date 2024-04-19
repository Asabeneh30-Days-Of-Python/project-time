<<?php 
//session start
session_start();

// unset all variables
$_SESSION = array();

//destroy session
session_destroy();

//redirect to login
header("location: project time management.php");
exit(); ?>