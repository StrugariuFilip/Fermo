<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $gmail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["pass"];
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = '6LelC_kpAAAAAAplN6ObMSbcLhFsuhrBPwyinovt';

    if (!empty($recaptchaResponse)) {
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $responseKeys = file_get_contents($recaptchaUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
        $responseKeys = json_decode($responseKeys, true);

        if ($responseKeys['success']) {
            if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) {
                $gmail = mysqli_real_escape_string($con, $gmail);
                $query = "SELECT id, name, email, pass FROM form WHERE email = ?";

                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt, "s", $gmail);
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_store_result($stmt);

                        mysqli_stmt_bind_result($stmt, $id, $name, $email, $hashed_password);

                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password)) {
                                session_regenerate_id(true);
                                $_SESSION['user_id'] = $id;
                                $_SESSION['username'] = $name;
                                $status = "Online";
                                $updateQuery = "UPDATE form SET status = ? WHERE id = ?";

                                if ($updateStmt = mysqli_prepare($con, $updateQuery)) {
                                    mysqli_stmt_bind_param($updateStmt, "si", $status, $_SESSION['user_id']);
                                    if (mysqli_stmt_execute($updateStmt)) {
                                        $redirect_to = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : 'profile.php';
                                        unset($_SESSION['redirect_to']);

                                        echo "<script type='text/javascript'>
                                            alert('Logare reușită');
                                            window.location.href = '$redirect_to';
                                        </script>";
                                        exit();
                                    } else {
                                        echo "<script type='text/javascript'>alert('Eroare la actualizarea statusului.');</script>";
                                    }
                                } else {
                                    echo "<script type='text/javascript'>alert('Eroare la pregătirea interogării de actualizare.');</script>";
                                }
                            } else {
                                echo "<script type='text/javascript'>alert('Email sau parolă greșită');</script>";
                            }
                        } else {
                            echo "<script type='text/javascript'>alert('Email sau parolă greșită');</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('Eroare la executarea interogării.');</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Eroare la pregătirea interogării.');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Email și parola sunt obligatorii');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Verificați reCAPTCHA.');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Completați reCAPTCHA.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="ro">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Conectare</title>
    <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
    <link rel="stylesheet" href="style/stylelog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
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
                    <h1 class="txt">Logare</h1>
                    <div class="text-box">
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="text-box">
                        <input type="password" placeholder="Parolă" name="pass" required>
                    </div>
                    <div class="forgot">
                        <a href="forgot-password.php">Ai uitat parola?</a>
                        <div class="capcha">
                            <div class="g-recaptcha" data-sitekey="6LelC_kpAAAAAA-_1LCHOOO_OecLP6h7MjurN7PI"></div>
                        </div>
                        <div class="buoton">
                            <input type="submit" value="Logare" class="login-btn" name="login_Btn">
                        </div>
                        <div class="signin">
                            Nu ai un cont făcut?
                            <br>
                            <a href="register.php">Înregistrează-te</a>
                        </div>
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