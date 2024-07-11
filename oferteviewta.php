<?php
   include "db.php"; 
   session_start();
   if (isset($_GET['id'])) {
       $id_oferta = $_GET['id'];
       $query = "SELECT * FROM oferte WHERE id = '$id_oferta'";
       $result = mysqli_query($con2, $query);
       if (mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>Vizualizare ofertă</title>
      <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
      <link rel="stylesheet" href="style/oferteview.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                $redirectUrl = 'https://fermo.shop/Fermo/profile.php';
            ?>
         <div class="container2">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagine']); ?>"
               alt="<?php echo $row['name']; ?>" class="poza-oferta2">
            <div class="informatie">
               <div class="infoo">
                  <div class="informatie-oferta2"><?php echo $row['name']; ?></div>
                  <div class="ofertaIcone">
                     <a href="<?php echo $redirectUrl; ?>" >
                     <i  class="fas fa-user useru"></i>
                     </a>
                  </div>
               </div>
               <div class="info2">
                  <br>
                  <div class="ofertaIcone2">
                     <a href="<?php echo $redirectUrl; ?>" >
                     <i  class="fas fa-user useru"></i>
                     </a>
                  </div>
                  <div class="locatie-oferta2"><?php echo $row['judet'] . ', ' . $row['address'] ; ?>&nbsp;
                  </div>
                  <div class="pret-oferta2" id="pret-oferta">Pret: <?php echo $row['pret'] ; ?></div>
                  <div class="cantitate-oferta2" id="cantitate-oferta">Cantitate produsa:
                     <?php echo $row['cantitate'] ; ?>
                  </div>
                  <div class="timp-oferta2" id="timp-oferta">Publicată pe: &nbsp;<?php echo $row['data']; ?></div>
                  <br>
                  <div class="descriere" id="descriere">
                     Descrierea produsului:  <br> 
                     <div class="descriere-casuta"><?php echo $row['descriere']; ?></div>
                  </div>
                  <div class ="review">
                  <div class="media">
                        Media recenziilor: &nbsp;
                    <?php
                     $user_ratings = json_decode($row['user_ratings'], true);
                                $query = "SELECT rating_total, rating_count, user_ratings FROM oferte WHERE id='$id_oferta'";
                                $result = mysqli_query($con2, $query);
                                $rate_users = json_decode($row['rating_users'], true);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $average_rating = $row['rating_count'] > 0 ? $row['rating_total'] / $row['rating_count'] : 0;
                        echo round($average_rating, 2) . '&nbsp; <div class="steluta">★</div>';
                        if ($row['rating_count'] == 1) {
                            echo "&nbsp;(&nbsp;" . $row['rating_count'] . " vot &nbsp;)";
                        } else {
                            echo "&nbsp;(&nbsp;"
                                                 . $row['rating_count'] . " voturi &nbsp;)";
                        }
                    } else {
                        echo "<p>Nici o recenzie încă</p>";
                    }
                    ?>
                </div>
                </div>
               </div>
            </div>
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
<?php
   } else {
       echo "Oferta nu există.";
   }
   } else {
   echo "ID-ul ofertei lipsă.";
   }
   ?>