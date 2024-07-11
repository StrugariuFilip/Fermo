<?php
include("db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userId = $_SESSION['user_id'];
    $uploadError = $_FILES["userImage"]["error"];
    $imagine = $_FILES["userImage"]["tmp_name"];

    if (!empty($imagine)) {
        $imgData = file_get_contents($imagine);
            $stmt = $con->prepare("INSERT INTO form (id, image) VALUES (?, ?) ON DUPLICATE KEY UPDATE image = VALUES(image)");
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($con->error));
            }
            $null = NULL; 
            $stmt->bind_param("ib", $userId, $null);
            $stmt->send_long_data(1, $imgData); 
            if ($stmt->execute()) {
                echo "<script>alert('Imaginea a fost adăugată cu succes.');</script>";
                echo "<script>window.location.href = 'profile.php';</script>";
                exit();
            } else {
                echo "<script>alert('Eroare: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        }
    }

$con->close();
?>


<!DOCTYPE html>
<html lang="ro">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>Schimbare profil</title>
      <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
      <link rel="stylesheet" href="style/imagine.css">
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
            <form method="post" enctype="multipart/form-data" class="formaa">
               <div class="logare">
                  <h1 class="txt">Schimbare imagine</h1>
                  <label for="userImage">Introduceți o imagine nouă</label>
                  <input type="file" name="userImage" id="userImage">
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
</html>