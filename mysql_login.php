<?php
require_once "common.php";

// Script for connecting to MySQL database
$hostname = "localhost";
$username = "den";
$password = "bestpassword";
$database = "cs174project";
$con = new mysqli($hostname, $username, $password, $database);
if($con->connect_error) mysqlError($con);

?>