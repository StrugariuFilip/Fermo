<?php
session_start();
include ("db.php");
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    if (isset($_GET['filter_text'])) {
        $filter_text = mysqli_real_escape_string($con, $_GET['filter_text']);
        $query = "SELECT * FROM form WHERE name = '$filter_text'";
    } else {
        $query = "SELECT * FROM form WHERE id = '$user_id'";
    }

    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Fermo</title>
            <link rel="icon" href=
"imagini/New Project.png"
          type="image/x-icon">
            <link rel="stylesheet" href="style/profileview.css">
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
                    <form id="searchForm" action="profiles.php" method="GET" class="top-search-container">
                        <input type="text" id="searchInput" class="top-search-input" name="filter_text"
                            placeholder="Caută utilizatori...">
                        <button type="submit" class="top-search-button">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <form action="oferte.php" method="GET">
            <div class="top-search-container2">
                    <input type="text" class="top-search-input2" name="search_query" placeholder="Caută produse...">
                    <button type="submit" class="top-search-button2">
                        <i class="fas fa-search"></i>
                    </button>
            </div>
            </form>
                    <a href="tutorialUniversal.html"><i class="fas fa-question-circle"></i></a>
                    <a href="profile.php"><i class="fas fa-user icon-user"></i></a>
                    <a href="cumparare.php" class="oferta">Adaugă o ofertă nouă</a>
                    <a href="cumparare.php" class="add-offer"><i class="fas fa-plus"></i></a>
                </div>
            </header>
            <nav>
            </nav>
            <main>
                <br>
                <br>
                <br>
                <br>
                <div class="profile">
                    <div class="sus">
                        <div class="welcome">
                                <h1>Contul lui <?php echo $row['name']; ?></h1>
                        </div>
                        <div class="iconu">
                            <i class="fas fa-user user-icon"></i>
                        </div>
                        <div class="contact-info">
                        <div class="cont-titlu">CONTACT:</div>
                            <div class="contactes">
                                 <div class="contactee1">
                                    <div class="txtcc">TELEFON:</div>
                                        <a href="tel:<?php echo $row['number']; ?>" class="phone-link">
                                          <span class="phone-text"><?php echo $row['number']; ?></span>
                                         </a>
                            
                                    <div><div class="txtcF">FIZIC:</div>
                                    <i class="fas fa-map-marker-alt location-icon"></i>
                                     <span class="additional-info"><?php echo $row['address']; ?></span>
                                    </div>
                                </div>
                                <div class="contactee2">
                                  <div class="txtcc">EMAIL:</div>
                                     <a href="mailto:<?php echo $row['email']; ?>" class="email-link">
                                     <span class="email-text"><?php echo $row['email']; ?></span>
                                     </a>
                                  </div>
                        </div>
                    </div>
                </div>
                <div class="mijloc">
                    <div class="despre">Descrierea lui 
                    <?php echo $row['name']; ?></div>
                    <div class="descriere">
                        <?php echo $row['descriere']; ?>
                    </div>
                </div>
                <div class="jos">
                   <a href="ofertelui.php?username=<?php echo $row['name']; ?>" class="oferte">Vezi ofertele lui <?php echo $row['name']; ?> </a>
                </div>
                </div>
                <br>
                <br>
                <br>
            </main>
            <!--Partea de jos-->
            <footer>
                <div>
                    <h2><strong class="contact-heading">Contactați-ne:</strong>
                        <i class="far fa-envelope envelope-icon"></i> <a href="mailto:fermo.contact@gmail.com"><span
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
        <?php
    } else {
        echo "Nu s-au găsit date pentru utilizatorul curent.";
    }
} else {
    header("Location: login.php");
    exit(); 
}
?>