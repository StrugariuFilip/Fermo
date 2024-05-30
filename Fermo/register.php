<?php
include ("db.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $address = $_POST["add"];
    $user_name = $_POST["name"];
    $gmail = $_POST["email"];
    $num = $_POST["number"];
    $password = $_POST["pass"];
    $check_email_query = "SELECT * FROM form WHERE email='$gmail'";
    $check_num_query = "SELECT * FROM form WHERE number='$num'";
    $check_username_query = "SELECT * FROM form WHERE name='$user_name'";
    
    $hashed_password=password_hash("$password", PASSWORD_DEFAULT);
    
    date_default_timezone_set("Europe/Bucharest");
    $currentDateTime = date('Y-m-d H:i:s');
    $result_email = mysqli_query($con, $check_email_query);
    $result_num = mysqli_query($con, $check_num_query);
    $result_username = mysqli_query($con, $check_username_query);
    if (mysqli_num_rows($result_email) > 0 && mysqli_num_rows($result_num) > 0 && mysqli_num_rows($result_username) > 0) {
        echo "<script type='text/javascript'>alert('Numele de utilizator , email și numărul de telefon sunt deja utilizate');</script>";
    } elseif (mysqli_num_rows($result_username) > 0 && mysqli_num_rows($result_num) > 0) {
        echo "<script type='text/javascript'>alert('Numele de utilizator si numărul de telefon sunt deja utilizate');</script>";
    } elseif (mysqli_num_rows($result_email) > 0 && mysqli_num_rows($result_username) > 0) {
        echo "<script type='text/javascript'>alert('Email-ul și numele de utilizator sunt deja utilizate');</script>";
    } elseif (mysqli_num_rows($result_username) > 0) {
        echo "<script type='text/javascript'>alert('Numele de utilizator este deja utilizat');</script>";
    } elseif (mysqli_num_rows($result_email) > 0 && mysqli_num_rows($result_num) > 0) {
        echo "<script type='text/javascript'>alert('Email-ul și numărul de telefon sunt deja utilizate');</script>";
    } elseif (mysqli_num_rows($result_email) > 0) {
        echo "<script type='text/javascript'>alert('Email-ul este deja utilizat');</script>";
    } elseif (mysqli_num_rows($result_num) > 0) {
        echo "<script type='text/javascript'>alert('Numărul de telefon este deja utilizat');</script>";
    } else {
        $insert_query = "INSERT INTO form (address, name, email, number, pass, data) VALUES ('$address', '$user_name', '$gmail', '$num', '$hashed_password', '$currentDateTime')";
        mysqli_query($con, $insert_query);
        echo "<script type='text/javascript'>alert('Înregistrare reușită , vă rugăm logați-vă');</script>";
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
    <link rel="icon" href=
"imagini/New Project.png"
          type="image/x-icon">
    <link rel="stylesheet" href="style/stylesign.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
        <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
</head>

<body>
    <header>
        <!--Sticky menu-->
        <div class="navbar">
           <a href="index.html">
            <img src="imagini/gugug.png" class="titlu">
             </a>
            <div class="top-search-container">
                <input type="text" class="top-search-input" name="search_query" placeholder="Caută produse...">
                <button type="submit" class="top-search-button" id="submitBtn">
                    <i class="fas fa-search"></i>
                </button>
                <script>
    document.getElementById("submitBtn").addEventListener("click", function(event) {
        event.preventDefault();

        alert("Loghează-te pentru a putea căuta oferte");
    });
</script>
            <a href="tutorialUniversal.html"><i class="fas fa-question-circle"></i></a>
            <a href="profile.php"><i class="fas fa-user icon-user"></i></a>
            <a href="cumparare.php" class="oferta">Adaugă o ofertă nouă</a>
            <a href="cumparare.php" class="add-offer"><i class="fas fa-plus"></i></a>
        </div>
    </header>
    <main>
        <form method="post">
            <div class="inregistrare">
                <h1 class="txt">Înregistrare</h1>
                <div class="text-box">
                    <label for="add">Selectați județul de domiciliu:</label>
                    <select id="add" name="add" required>
                        <option value="" disabled selected>Selectați un județ </option>
                        <option value="Alba">Alba</option>
                        <option value="Arad">Arad</option>
                        <option value="Arges">Arges</option>
                        <option value="Bacau">Bacau</option>
                        <option value="Bihor">Bihor</option>
                        <option value="Bistrita-Nasaud">Bistrita-Nasaud</option>
                        <option value="Botosani">Botosani</option>
                        <option value="Brasov">Brasov</option>
                        <option value="Braila">Braila</option>
                        <option value="Buzau">Buzau</option>
                        <option value="Caras-Severin">Caras-Severin</option>
                        <option value="Calarasi">Calarasi</option>
                        <option value="Cluj">Cluj</option>
                        <option value="Constanta">Constanta</option>
                        <option value="Covasna">Covasna</option>
                        <option value="Dambovita">Dambovita</option>
                        <option value="Dolj">Dolj</option>
                        <option value="Galati">Galati</option>
                        <option value="Giurgiu">Giurgiu</option>
                        <option value="Gorj">Gorj</option>
                        <option value="Harghita">Harghita</option>
                        <option value="Hunedoara">Hunedoara</option>
                        <option value="Ialomita">Ialomita</option>
                        <option value="Iasi">Iasi</option>
                        <option value="Ilfov">Ilfov</option>
                        <option value="Maramures">Maramures</option>
                        <option value="Mehedinti">Mehedinti</option>
                        <option value="Mures">Mures</option>
                        <option value="Neamt">Neamt</option>
                        <option value="Olt">Olt</option>
                        <option value="Prahova">Prahova</option>
                        <option value="Satu Mare">Satu Mare</option>
                        <option value="Salaj">Salaj</option>
                        <option value="Sibiu">Sibiu</option>
                        <option value="Suceava">Suceava</option>
                        <option value="Teleorman">Teleorman</option>
                        <option value="Timis">Timis</option>
                        <option value="Tulcea">Tulcea</option>
                        <option value="Vaslui">Vaslui</option>
                        <option value="Valcea">Valcea</option>
                        <option value="Vrancea">Vrancea</option>
                    </select>
                </div>
                <div class="text-box">
                    <input type="text" id="name" placeholder="Nume de utilizator" name="name" required>
                </div>
                <div class="text-box">
                    <input type="email" id="email" placeholder="Email" name="email" required>
                </div>
                <div class="text-box">
                    <input type="tel" id="number" placeholder="Număr de telefon (10 cifre)" name="number"
                        pattern="[0-9]{10}" title="Introduceți un număr de telefon valid format din 10 cifre" required>
                </div>
                <div class="text-box">
                    <input type="password" id="pass" placeholder="Parolă" name="pass" required>
                </div>
                <input type="submit" value="Înregistrare" id="submit" class="sign-btn" name="sign_Btn" required>
                <div class="signup">
                    Ai deja cont făcut?
                    <br>
                    <a href="login.php">Loghează-te</a>
                </div>
            </div>
        </form>
        <div class="bara"></div>
    </main>
    <footer>
        <div>
            <h2><strong class="contact-heading">Contactați-ne:</strong>
                <i class="far fa-envelope envelope-icon"></i> <a href="mailto:fermo.contact@gmail.com" class="email-link"><span
                        class="email-text">fermo.contact@gmail.com</span></a>
                <span>&nbsp|&nbsp</span>
                <span><i class="fas fa-phone phone-icon"></i> <a href="tel:0738921081" class="phone-link"><span
                            class="phone-text">0738921081</span></a></span>
                <a href="desprenoi.html" class="right-text"><strong>Despre noi</strong></a>
            </h2>
        </div>
    </footer>
</body>

</html>