<?php
include ("db.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fermo</title>
    <link rel="stylesheet" href="style/profiles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
</head>

<body>
    <header>
        <!-- Sticky menu -->
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
    <main>
        <br><br>
        <br><br><br><br>
       <?php
        if (isset($_GET['filter_text'])) {
            $filter_text = $_GET['filter_text'];
            $query = "SELECT name, number, email, address, descriere, data FROM form WHERE name LIKE '%$filter_text%' OR email LIKE '%$filter_text%'";
            $result = mysqli_query($con, $query);
            $num_results = mysqli_num_rows($result);
             $logged_in_user = $_SESSION['username'];
            if ($num_results > 0) {
                echo "<h2>Am găsit $num_results ";
                echo ($num_results == 1) ? "rezultat" : "rezultate";
                echo " pentru tine</h2> <br><br> ";
                while ($row = mysqli_fetch_assoc($result)) { 
                 $profile_url = ($row['name'] == $logged_in_user) ? "profile.php" : "profileview.php?filter_text=" . urlencode($row['name']);?>
                    <a href="<?php echo $profile_url; ?>" class="linke">
                        <div class="container1">
                            <div class="informatie">
                                <div class="informatie-profile"><?php echo $row['name']; ?></div>
                                <div class="data">Cont creat pe : <?php echo $row['data']; ?></div>
                                <div class="address">Adresă : <?php echo $row['address']; ?></div>
                                <div class="email-profile">Email : <?php echo $row['email']; ?></div>
                                <div class="number">Număr: <?php echo $row['number']; ?></div>
                                <div class="descriere">Descriere : <?php echo $row['descriere']; ?></div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<br><br><p style=\"font-size:35px;\">Nu există utilizatori disponibili.</p><br><br><br><br>";
            }
        }
        ?>
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