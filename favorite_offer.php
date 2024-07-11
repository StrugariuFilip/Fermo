<?php
include "db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offer_id = $_POST['offer_id'];
    $nume_utilizator = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    $query = "SELECT favorite FROM oferte WHERE id = '$offer_id'";
    $result = mysqli_query($con2, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $favorites = json_decode($row['favorite'], true);

        if (!is_array($favorites)) {
            $favorites = [];
        }

        if (in_array($nume_utilizator, $favorites)) {
            $favorites = array_diff($favorites, [$nume_utilizator]);
            echo "<script>alert('Ai scos oferta de la favorite');</script>";
            echo "<script>window.location.href = 'oferteview.php?id=$offer_id';</script>";
        } else {
            $favorites[] = $nume_utilizator;
            echo "<script>alert('Ai adăugat oferta la favorite');</script>";
            echo "<script>window.location.href = 'oferteview.php?id=$offer_id';</script>";
        }

        $favorites_json = json_encode($favorites);
        $update_query = "UPDATE oferte SET favorite = '$favorites_json' WHERE id = '$offer_id'";
        mysqli_query($con2, $update_query);
    }
}
