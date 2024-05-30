<?php
include ("db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['offer_id'])) {
    $offer_id = $_POST['offer_id'];
    
    $query = "SELECT * FROM oferte WHERE id = '$offer_id' AND nume_utilizator = '{$_SESSION['username']}'";
    $result = mysqli_query($con2, $query);

    if (mysqli_num_rows($result) == 1) {
        $delete_query = "DELETE FROM oferte WHERE id = '$offer_id'";
        if (mysqli_query($con2, $delete_query)) {
            header("Location: oferteta.php");
            exit();
        } else {
            echo "Eroare la ștergerea ofertei: " . mysqli_error($con2);
        }
    } else {
        echo "Oferta nu există sau nu ai permisiunea să o ștergi.";
    }
}
?>
<html>

</html>