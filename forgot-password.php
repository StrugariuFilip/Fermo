<?php
include("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    date_default_timezone_set("Europe/Bucharest");
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    $query = "UPDATE form SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expiry, $email);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $mail = require __DIR__ . '/mailer.php';
            $mail->setFrom("contact@fermo.shop");
            $mail->addAddress($email);
            $mail->Subject = "Resetare parola";
            $mail->Body = <<<END
Apasă <a href="https://fermo.shop/Fermo/reset-password.php?token=$token">aici</a> pentru a îți schimba parola. Acest link va expira în 30 de minute.
END;

            try {
                $mail->send();
                echo "<script>alert('Email-ul a fost trimis. Veți găsi acolo instrucțiunile pe care trebuie să le urmați mai departe.'); window.location.href = 'https://fermo.shop/Fermo/login.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Eroare la trimiterea email-ului: {$mail->ErrorInfo}');</script>";
            }
        } else {
            echo "<script>alert('Email-ul nu a fost găsit în baza de date.'); window.location.href = 'forgot-password.php';</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Eroare la pregătirea interogării: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>Resetare parolă</title>
      <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
      <link rel="stylesheet" href="style/forgot-password.css">
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
                  <h1 class="txt">Resetare parolă</h1>
                  <div class="text-box">
                     <label for="email">Adaugă email-ul contului a cărui parolă vrei să o resetezi</label>
                     <input type="email" style="margin-top:10px;" placeholder="Email" name="email" required>
                  </div>
                  <div class="buoton">
                     <input type="submit" value="Trimite" class="login-btn" name="login_Btn">
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
</html>