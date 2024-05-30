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
    <link rel="stylesheet" href="style/ofertelui.css">
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
        $source = "";
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            $source = "URL";
        } else {
            $username = $_SESSION['username'];
            $source = "sesiune";
        }
        $query = "SELECT * FROM oferte WHERE nume_utilizator = '$username'";
        $result = mysqli_query($con2, $query);
        $num_results = mysqli_num_rows($result);

        if (!$result) {
            echo "Eroare la executarea interogării: " . mysqli_error($con2);
        } else {
            if ($source == "URL") {
                if ($num_results != 0) {
                    echo "<br>\n"."<h2>$username a publicat $num_results ";
                    echo ($num_results == 1) ? "ofertă." : "oferte.";
                    echo "</h2>";
                } else {
                    echo "<br>\n" . "<br>\n" . "<br>\n"."<br>\n" ."<br>\n" ."<br>\n" ."<br>\n" ."<br>\n" . "<p style=\"font-size:35px;\">$username nu a publicat nici o ofertă.</p>" . "<br>\n" . "<br>\n" . "<br>\n" . "<br>\n";
                }
            } elseif ($source == "sesiune") { {
                    if ($num_results != 0) {
                        echo "<h2>Ai publicat $num_results ";
                        echo ($num_results == 1) ? "ofertă." : "oferte.";
                        echo "</h2>";
                    } else {
                        echo "<br>\n" . "<br>\n"  . "<br>\n" . "<br>\n" ."<p style=\"font-size:35px;\">Nu ai publicat nici o ofertă.</p>" . "<br>\n" . "<br>\n" . "<br>\n" . "<br>\n";
                    }
                }
            }

            while ($row = mysqli_fetch_assoc($result)) { { ?>
                    <a href="oferteview.php?id=<?php echo $row['id']; ?>" class="linke">
                        <div class="container1">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagine']); ?>"
                                alt="<?php echo $row['name']; ?>" class="poza-oferta1">
                            <div class="informatie">
                                <div class="informatie-oferta1"><?php echo $row['name']; ?></div>
                                <div class="locatie-oferta1"><?php echo $row['judet'] . ', ' . $row['address']; ?>&nbsp;</div>
                                <div class="pret-oferta1">Pret: <?php echo $row['pret'] ?></div>
                                <div class="cantitate-oferta1">Cantitate produs: <?php echo $row['cantitate']; ?></div>
                                <div class="descriere-oferta1">Descriere produs: <?php echo $row['descriere']; ?></div>
                                <div class="timp-oferta1" style="color: black; font-size: 16px;">Publicată
                                    pe:&nbsp;<?php echo $row['data'] ?></div>
                            </div>
                        </div>
                    </a>
                    <?php
                }

            }
        }

        ?>

    </main>
    <br> <br> <br><br><br><br>
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