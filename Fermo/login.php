<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $gmail = $_POST["email"];
    $password = $_POST["pass"];
    
    if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) {

        $gmail = mysqli_real_escape_string($con, $gmail);
        $query = "SELECT * FROM form WHERE email = '$gmail'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            $dbpass = $user_data["pass"];
            if (password_verify($password, $dbpass)) {
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['name'];
                header("Location: profile.php");
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Email sau parolă greșită');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Email sau parolă greșită');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Email și parola sunt obligatorii');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectare</title>
    <link rel="icon" href=
"../imagini/New Project.png"
          type="image/x-icon">
    <link rel="stylesheet" href="style/stylelog.css"> 
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
                <img src="imagini/gugug.png" alt="Descrierea imaginii" class="titlu">
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
            </div>
            <a href="tutorialUniversal.html"><i class="fas fa-question-circle"></i></a>
            <a href="profile.php"><i class="fas fa-user icon-user"></i></a>
            <a href="cumparare.php" class="oferta">Adaugă o ofertă nouă</a>
            <a href="cumparare.php" class="add-offer"><i class="fas fa-plus"></i></a>
        </div>
    </header>
    <main>
        <form method="post">
            <div class="logare">
                <h1 class="txt">Logare</h1>
                <div class="text-box">
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="text-box">
                    <input type="password" placeholder="Parolă" name="pass" required>
                </div>
                <input type="submit" value="Logare" class="login-btn" name="login_Btn">
                <div class="signin">
                    Nu ai un cont făcut?
                    <br>
                    <a href="register.php">Înregistrează-te</a>
                </div>
                <br>
                <br>
            </div>
        </form>
    </main>
    <br>
    <br>
    <div class="bara"></div>
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