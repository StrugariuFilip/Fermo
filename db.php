<?php
$servername = "";
$username = "";
$password = "";

$database = "";
$con = new mysqli($servername, $username, $password, $database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$database2 = "";
$con2 = new mysqli($servername, $username, $password, $database2);
if ($con2->connect_error) {
    die("Connection failed: " . $con2->connect_error);
}

$database3 = "";
$con3 = new mysqli($servername, $username, $password, $database3);
if ($con3->connect_error) {
    die("Connection failed: " . $con3->connect_error);
}
?>
