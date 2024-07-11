<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include "db.php";
    $logout_id = mysqli_real_escape_string($con, $_GET['logout_id']);
    if (isset($logout_id)) {
        $status = "Offline";
        $sql = mysqli_query($con, "UPDATE form SET status = '{$status}' WHERE id={$_GET['logout_id']}");
        if ($sql) {
            session_unset();
            session_destroy();
            header("location: ../login.php");
        }
    } else {
        header("location: https://fermo.shop/Fermo/users.php");
    }
} else {
    header("location: ../login.php");
}
?>