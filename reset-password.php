<?php
include("db.php");
date_default_timezone_set("Europe/Bucharest");

if (!isset($_GET["token"])) {
    die("Token-ul lipsește.");
}

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$query = "SELECT id, reset_token_expires_at FROM form WHERE reset_token_hash = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$stmt->bind_result($id, $reset_token_expires_at);

if ($stmt->fetch()) {
    if (strtotime($reset_token_expires_at) <= time()) {
        die("Token-ul a expirat. Vă rugăm faceți altă cerere de resetare a parolei.");
    }
} else {
    die("Token-ul nu a fost găsit");
}

$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass1 = $_POST["pass"];
    $pass2 = $_POST["pass2"];
    $ok = 1;

    if (strlen($pass1) < 8) {
        echo "<script>alert('Parola trebuie să aibă minim 8 caractere.');</script>";
        $ok = 0;
    }
    if (!preg_match("/[a-z]/i", $pass1)) {
        echo "<script>alert('Parola trebuie să conțină minim o literă.');</script>";
        $ok = 0;
    }
    if (!preg_match("/[0-9]/i", $pass1)) {
        echo "<script>alert('Parola trebuie să conțină minim o cifră.');</script>";
        $ok = 0;
    }
    if ($pass1 !== $pass2) {
        echo "<script>alert('Parolele nu coincid.');</script>";
        $ok = 0;
    }

    if ($ok == 1) {
        $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

        $update_query = "UPDATE form SET pass = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";
        $update_stmt = $con->prepare($update_query);
        $update_stmt->bind_param("si", $hashed_password, $id);

        if ($update_stmt->execute()) {
            echo "<script>alert('Parola a fost actualizată.'); window.location.href = 'https://fermo.shop/Fermo/login.php';</script>";
        } else {
            echo "Eroare la actualizarea parolei: " . $con->error;
        }

        $update_stmt->close();
    }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="ro">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>Resetare parolă</title>
      <link rel="icon" href="../imagini/New Project.png" type="image/x-icon">
      <link rel="stylesheet" href="style/reset-password.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
         integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
         crossorigin="anonymous" />
      <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   </head>
   <body>
        <header>
              <div class="left">
                <a href="index.html">
                  <img src="imagini/gugug.png" class="titlu">
                </a>
              </div>
              <div class="middle">
                     <form action="oferte.php" method="GET">
                  <div class="top-search-container2">
                    <input type="text" class="top-search-input2" name="search_query" placeholder="Caută produse...">
                    <button type="submit" class="top-search-button2">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </form>
                <form id="searchForm" action="profiles.php" method="GET" class="top-search-container">
                  <input type="text" id="searchInput" class="top-search-input" name="filter_text" placeholder="Caută utilizatori...">
                  <button type="submit" class="top-search-button">
                    <i class="fas fa-search"></i>
                  </button>
                </form>
              </div>
              <div class="right">
                <div class="icons-container">
                  <a href="tutorialUniversal.html"><i class="fas fa-question-circle"></i></a>
                  <a href="users.php"><i class="fas fa-comment"></i></a>
                  <a href="profile.php"><i class="fas fa-user icon-user"></i></a>
                  <a href="cumparare.php" class="oferta">Adaugă o ofertă nouă</a>
                </div>
              </div>
              <div class="hamburger-menu">
                <i class="fas fa-bars"></i>
              </div>
        </header>
    
            <div class="dropdown-menu">
                   <form action="oferte.php" method="GET">
                  <div class="top-search-container2">
                    <input type="text" class="top-search-input2" name="search_query" placeholder="Caută produse...">
                    <button type="submit" class="top-search-button2">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </form>
                <form id="searchForm" action="profiles.php" method="GET" class="top-search-container">
                  <input type="text" id="searchInput" class="top-search-input" name="filter_text" placeholder="Caută utilizatori...">
                  <button type="submit" class="top-search-button">
                    <i class="fas fa-search"></i>
                  </button>
                </form>
                
              <a href="tutorialUniversal.html"><i class="fas fa-question-circle"></i> Tutorial</a>
              <a href="users.php"><i class="fas fa-comment"></i>&nbsp;Mesaje</a>
              <a href="profile.php"><i class="fas fa-user icon-user"></i> Profil</a>
              <a href="cumparare.php"><i class="fas fa-plus"></i> Adaugă ofertă</a>
            </div>
      <main>
         <div class="chenar">
            <form method="post" class="formaa">
               <div class="logare">
                  <h1 class="txt">Schimbare parolă</h1>
                  <label for="pass">Introduceți o parolă nouă</label>
                  <div class="text-box">
                     <input type="password" id="pass" placeholder="Parolă" name="pass"
                        title="Parola trebuie să conțină minim 8 caractere și cel puțin o cifră." required>
                  </div>
                  <label for="pass2">Reintroduceți parola</label>
                  <div class="text-box">
                     <input type="password" id="pass2" placeholder="Reintroduceți parola" name="pass2"
                        title="Parola trebuie să fie identică cu cea de mai sus." required>
                  </div>
                  <div class="buoton">
                     <input type="submit" value="Confirmă" class="login-btn" name="login_Btn">
                  </div>
               </div>
            </form>
         </div>
      </main>
      <script src="script.js"></script>
      <footer>
         <div class="jos">
            <div class="stanga">
               <div class="contact-heading">Contactați-ne:</div>
               <div class="email">
                  <i class="far fa-envelope envelope-icon"></i>
                  <a href="mailto:fermo.contact@gmail.com" class="email-link">
                  <span class="email-text">fermo.contact@gmail.com</span>
                  </a>
               </div>
               <span class="separator">&nbsp;|&nbsp;</span>
               <div class="telefon">
                  <i class="fas fa-phone phone-icon"></i>
                  <a href="tel:0738921081" class="phone-link">
                  <span class="phone-text">0738921081</span>
                  </a>
               </div>
            </div>
            <div class="rightf">
               <a href="desprenoi.html" class="right-text">Despre noi</a>
            </div>
         </div>
      </footer>
   </body>
</html>v
