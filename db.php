<?php
$servername = "server39.web-hosting.com";
$username = "fermddgw_Filip";
$password = "Deltaplan2006";

$database = "fermddgw_register";
$con = new mysqli($servername, $username, $password, $database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$database2 = "fermddgw_Oferte";
$con2 = new mysqli($servername, $username, $password, $database2);
if ($con2->connect_error) {
    die("Connection failed: " . $con2->connect_error);
}

$database3 = "fermddgw_chat";
$con3 = new mysqli($servername, $username, $password, $database3);
if ($con3->connect_error) {
    die("Connection failed: " . $con3->connect_error);
}
?>
