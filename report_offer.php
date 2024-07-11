<?php
include("db.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_to'] = "https://fermo.shop/Fermo/oferteview.php?id=" . urlencode($_POST['offer_id']);
    header("Location: login.php");
    exit();
}

$nume_utilizator = $_SESSION['username'];
$offer_id = $_POST['offer_id'];

if (!filter_var($offer_id, FILTER_VALIDATE_INT)) {
    echo '<script>alert("ID-ul ofertei nu este valid.");window.location.href = "https://fermo.shop/Fermo/oferteview.php?id=' . urlencode($offer_id) . '";</script>';
    exit();
}

$query = "SELECT * FROM oferte WHERE id = ?";
$stmt = mysqli_prepare($con2, $query);
mysqli_stmt_bind_param($stmt, 'i', $offer_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $name, $description, $price, $quantity, $category, $state, $report_users, $report_count, $data, $image);

if (mysqli_stmt_fetch($stmt)) {
    $report_users = json_decode($report_users, true);
    
    if (!is_array($report_users)) {
        $report_users = [];
    }

    if (in_array($nume_utilizator, $report_users)) {
        mysqli_stmt_close($stmt);
        echo '<script>alert("Utilizatorul a raportat deja această ofertă.");window.location.href = "https://fermo.shop/Fermo/oferteview.php?id=' . urlencode($offer_id) . '";</script>';
        exit();
    } else {
        $report_users[] = $nume_utilizator;
        $new_report_users = json_encode($report_users);
        $new_report_count = $report_count + 1;

        if ($new_report_count >= 5) {
            mysqli_stmt_close($stmt);
            $delete_query = "DELETE FROM oferte WHERE id = ?";
            $delete_stmt = mysqli_prepare($con2, $delete_query);
            mysqli_stmt_bind_param($delete_stmt, 'i', $offer_id);
            if (mysqli_stmt_execute($delete_stmt)) {
                mysqli_stmt_close($delete_stmt);
                echo '<script>alert("Oferta a fost ștearsă din cauza numărului mare de rapoarte.");window.location.href = "https://fermo.shop/Fermo/oferte.php?search_query=";</script>';
                exit();
            } else {
                mysqli_stmt_close($delete_stmt);
                echo '<script>alert("Eroare la ștergerea ofertei: ' . mysqli_error($con2) . '");window.location.href = "https://fermo.shop/Fermo/oferteview.php?id=' . urlencode($offer_id) . '";</script>';
                exit();
            }
        } else {
            mysqli_stmt_close($stmt);
            $sql_update = "UPDATE oferte SET report_users = ?, report_count = ? WHERE id = ?";
            $update_stmt = mysqli_prepare($con2, $sql_update);
            mysqli_stmt_bind_param($update_stmt, 'sii', $new_report_users, $new_report_count, $offer_id);
            if (mysqli_stmt_execute($update_stmt)) {
                mysqli_stmt_close($update_stmt);
                echo '<script>alert("Oferta a fost raportată cu succes.");window.location.href = "https://fermo.shop/Fermo/oferteview.php?id=' . urlencode($offer_id) . '";</script>';
                $_SESSION['reported_offer_ids'][$offer_id] = true;
                exit();
            } else {
                mysqli_stmt_close($update_stmt);
                echo '<script>alert("Eroare la actualizarea ofertei: ' . mysqli_error($con2) . '");window.location.href = "https://fermo.shop/Fermo/oferteview.php?id=' . urlencode($offer_id) . '";</script>';
                exit();
            }
        }
    }
} else {
    mysqli_stmt_close($stmt);
    echo '<script>alert("Oferta nu a fost găsită.");window.location.href = "https://fermo.shop/Fermo/oferteview.php?id=' . urlencode($offer_id) . '";</script>';
    exit();
}

mysqli_close($con2);
?>
