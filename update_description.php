<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_POST['user_id'];
    $new_description = $_POST['new_description'];

    echo "User ID: $user_id<br>";
    echo "New Description: $new_description<br>";

    $query = "UPDATE form SET descriere = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $new_description, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: profile.php?success=1");
        } else {
            echo "A apărut o eroare în timpul actualizării descrierii: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Eroare la pregătirea interogării: " . mysqli_error($con);
    }
} else {
    header("Location: profile.php");
    exit();
}
?>
