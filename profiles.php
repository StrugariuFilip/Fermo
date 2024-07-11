<?php
   include ("db.php");
   session_start();
   $current_user_name = $_SESSION['username'];
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>Profiluri</title>
      <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
      <link rel="stylesheet" href="style/profiles.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
      <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
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
         <div class="content">
            <?php
               if (isset($_GET['filter_text'])) {
                   $filter_text = $_GET['filter_text'];
                   $query = "SELECT name, number, email, address, descriere, data FROM form WHERE (name LIKE '%$filter_text%' OR email LIKE '%$filter_text%')  AND name != '$current_user_name'";
                   $result = mysqli_query($con, $query);
                   $num_results = mysqli_num_rows($result);
                    $logged_in_user = $_SESSION['username'];
                   if ($num_results > 0) {
                       if($num_results > 1)
                       {echo "<h2>Am găsit $num_results rezultate pentru tine</h2> <br><br> ";}
                       if($num_results == 1)
                       {
                           echo "<br><br><br><br><h2>Am găsit $num_results rezultat pentru tine</h2> <br><br> ";
                           
                       }
                       while ($row = mysqli_fetch_assoc($result)) { 
                        $profile_url ="profileview.php?filter_text=" . urlencode($row['name']);?>
            <a href="<?php echo $profile_url; ?>" class="linke">
               <div class="container1">
                  <div class="informatie">
                     <div class="informatie-profile"><?php echo $row['name']; ?></div>
                     <div class="data">Cont creat pe : <?php echo $row['data']; ?></div>
                     <div class="address">Adresă : <?php echo $row['address']; ?></div>
                     <div class="number">Număr de telefon: <?php echo $row['number']; ?></div>
                     <div class="descriere">Descriere : <?php echo $row['descriere']; ?></div>
                  </div>
               </div>
            </a>
            <?php 
               }
               if($num_results == 1)
                       {
                           echo "<br><br><br>";
                           
                       }
               } else {
               echo "<p style=\"font-size:35px; margin-top:200px;margin-bottom:200px;\">Nu există utilizatori disponibili.</p>";
               }
               }
               ?>
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