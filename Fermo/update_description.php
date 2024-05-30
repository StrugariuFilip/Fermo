<?php
session_start();
include ("db.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['user_id'])) {

        header("Location: login.php");
        exit(); 
    }

    $user_id = $_POST['user_id'];
    $new_description = $_POST['new_description'];

    $query = "UPDATE form SET descriere = '$new_description' WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("Location: profile.php?success=1");
    } else {
        echo "A apărut o eroare în timpul actualizării descrierii.";
    }
} else {
    header("Location: profile.php");
    exit(); 
}
