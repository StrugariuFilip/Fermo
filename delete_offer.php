<?php
include("db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offer_id'])) {
    $offer_id = filter_var($_POST['offer_id'], FILTER_VALIDATE_INT);
    if ($offer_id === false) {
        echo '<script>alert("ID-ul ofertei nu este valid.");window.location.href = "https://fermo.shop/Fermo/oferteta.php";</script>';
        exit();
    }

    $username = $_SESSION['username'];

    $query = "SELECT id FROM oferte WHERE id = ? AND nume_utilizator = ?";
    if ($stmt = $con2->prepare($query)) {
        $stmt->bind_param("is", $offer_id, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $delete_query = "DELETE FROM oferte WHERE id = ?";
            if ($delete_stmt = $con2->prepare($delete_query)) {
                $delete_stmt->bind_param("i", $offer_id);
                if ($delete_stmt->execute()) {
                    echo '<script>alert("Oferta a fost ștearsă cu succes.");window.location.href = "https://fermo.shop/Fermo/oferteta.php";</script>';
                } else {
                    echo "Eroare la ștergerea ofertei: " . $delete_stmt->error;
                }
                $delete_stmt->close();
            } else {
                echo "Eroare la pregătirea ștergerii ofertei: " . $con2->error;
            }
        } else {
            echo '<script>alert("Oferta nu există sau nu ai permisiunea să o ștergi.");window.location.href = "https://fermo.shop/Fermo/oferteta.php";</script>';
        }
        $stmt->close();
    } else {
        echo "Eroare la pregătirea interogării: " . $con2->error;
    }
}
?>