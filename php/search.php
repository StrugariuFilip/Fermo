<?php
session_start();
include "db.php";

$outgoing_id = $_SESSION['user_id'];
$searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);

$sql = "SELECT * FROM form WHERE NOT id = {$outgoing_id} AND (name LIKE '%{$searchTerm}%') ";
$output = "";
$query = mysqli_query($con, $sql);
if (mysqli_num_rows($query) > 0) {
    include "data.php";
} else {
    $output .= 'Nici un utilizator cu numele căutat.';
}
echo $output;
?>