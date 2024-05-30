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
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Fermo</title>
            <link rel="stylesheet" href="style/oferteview.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <input type="text" id="searchInput" class="top-search-input" name="filter_text" placeholder="Caută utilizatori...">
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
            <br> <br> <br>
            <main>
                <?php
                    $loggedInUser = $_SESSION['username'];
                    if ($row['nume_utilizator'] === $loggedInUser) {
                        $redirectUrl = 'https://fermo.shop/Fermo/profile.php';
                    } else {
                        $redirectUrl = 'https://fermo.shop/Fermo/profileview.php?filter_text=' . urlencode($row['nume_utilizator']);
                    }
                ?>
                <div class="container2">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagine']); ?>"
                        alt="<?php echo $row['name']; ?>" class="poza-oferta2">
                    <div class="informatie">
                          <div class="ofertaProfilIcon">
                            <a href="<?php echo $redirectUrl; ?>" >
                                <i  class="fas fa-user useru"></i>
                            </a>
                        </div>
                        <div class="informatie-oferta2"><?php echo $row['name']; ?></div>
                        <div class="locatie-oferta2"><?php echo $row['judet'] . ', ' . $row['address'] ; ?>&nbsp;
                        </div>
                        <div class="pret-oferta2" id="pret-oferta">Pret: <?php echo $row['pret'] ; ?></div>
                        <div class="cantitate-oferta2" id="cantitate-oferta">Cantitate produsa:
                            <?php echo $row['cantitate'] ; ?>
                        </div>
                           <div class="timp-oferta2" id="timp-oferta">Publicată pe: &nbsp;<?php echo $row['data']; ?></div>
                        <br>
                        <div class="descriere" id="descriere">Descrierea produsului:  <br> 
                            <div class="descriere-casuta"><?php echo $row['descriere']; ?></div></div>
                    </div>
                </div>
            </main>
            <br> <br> <br>
            <footer>
                <div>
                    <h2><strong class="contact-heading">Contactați-ne:</strong>
                        <i class="far fa-envelope envelope-icon"></i> <a href="mailto:fermo.contact@gmail.com"
                            class="email-link"><span class="email-text">fermo.contact@gmail.com</span></a>
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
        echo "Oferta nu există.";
    }
} else {
    echo "ID-ul ofertei lipsă.";
}
?>