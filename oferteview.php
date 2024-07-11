<?php
include "db.php";
session_start();
if (!isset($_SESSION['user_id']))
{
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}
if (isset($_GET['id'])) {
    $id_oferta = $_GET['id'];
    $query = "SELECT * FROM oferte WHERE id = '$id_oferta'";
    $result = mysqli_query($con2, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nume_utilizator = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $report_users = json_decode($row['report_users'], true);
        $is_current_offer_reported = false;
        if (is_array($report_users) && in_array($nume_utilizator, $report_users)) {
            $is_current_offer_reported = true;
        }
        if (isset($_SESSION['reported_offer_ids'][$id_oferta]) && $_SESSION['reported_offer_ids'][$id_oferta] === true) {
            $is_current_offer_reported = true;
        }

        $favorite_users = json_decode($row['favorite'], true);
        $is_current_offer_favorited = false;

        if (is_array($favorite_users) && in_array($nume_utilizator, $favorite_users)) {
            $is_current_offer_favorited = true;
        }

        $nume_utilizator_escaped = mysqli_real_escape_string($con2, $row['nume_utilizator']);

        $query_user = "SELECT id FROM form WHERE name = '$nume_utilizator_escaped'";
        $result_user = mysqli_query($con, $query_user);

        if (mysqli_num_rows($result_user) > 0) {
            $row_user = mysqli_fetch_assoc($result_user);
            $user_id = $row_user['id'];
            $redirectUrl2 = 'chat.php?user_id=' . urlencode($user_id);
        } else {
            $redirectUrl = '#';
        }
        $redirectUrl = 'profileview.php?filter_text=' . urlencode($row['nume_utilizator']);
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
                    <div class="container2">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagine']); ?>"
                            alt="<?php echo $row['name']; ?>" class="poza-oferta2">
                        <div class="informatie">
                            <div class="infoo">
                                <div class="informatie-oferta2"><?php echo $row['name']; ?></div>
                                <div class="ofertaIcone">
                                    <a href="<?php echo $redirectUrl2; ?>">
                                        <i class="fas fa-comment commu"></i>
                                    </a>
                                    <a href="<?php echo $redirectUrl; ?>">
                                        <i class="fas fa-user useru"></i>
                                    </a>
                                    <?php if ($is_current_offer_reported == false) { ?>
                                        <form action="report_offer.php" method="POST"
                                            onsubmit="return confirm('Esti sigur ca vrei sa raportezi aceasta oferta?');"
                                            class="delete">
                                            <input type="hidden" name="offer_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="delete-button ">
                                                <i class="fas fa-flag"></i>
                                                Raportează oferta
                                            </button>
                                        </form>
                                    <?php }
                                    if ($is_current_offer_reported == true) { ?>
                                        <button class="delete-button submitted">
                                            <i class="fas fa-flag"></i>
                                            Oferta raportată
                                        </button>
                                    <?php } ?>
                                    <div class="favorite-container">
                                        <form action="favorite_offer.php" method="POST" class="favorite-form">
                                            <input type="hidden" name="offer_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit"
                                                class="favorite-button <?php echo $is_current_offer_favorited ? 'favorited' : ''; ?>">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="info2">
                                <br>
                                <div class="ofertaIcone2">
                                    <a href="<?php echo $redirectUrl2; ?>">
                                        <i class="fas fa-comment commu"></i>
                                    </a>
                                    <a href="<?php echo $redirectUrl; ?>">
                                        <i class="fas fa-user useru"></i>
                                    </a>
                                    <?php if ($is_current_offer_reported == false) { ?>
                                        <form action="report_offer.php" method="POST"
                                            onsubmit="return confirm('Esti sigur ca vrei sa raportezi aceasta oferta?');"
                                            class="delete">
                                            <input type="hidden" name="offer_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="delete-button ">
                                                <i class="fas fa-flag"></i>
                                                Raportează oferta
                                            </button>
                                        </form>
                                    <?php }
                                    if ($is_current_offer_reported == true) { ?>
                                        <button class="delete-button submitted" type="sumbit">
                                            <i class="fas fa-flag"></i>
                                            Oferta raportată
                                        </button>
                                    <?php } ?>
                                    <div class="favorite-container">
                                        <form action="favorite_offer.php" method="POST" class="favorite-form">
                                            <input type="hidden" name="offer_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit"
                                                class="favorite-button <?php echo $is_current_offer_favorited ? 'favorited' : ''; ?>">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="locatie-oferta2"><?php echo $row['judet'] . ', ' . $row['address']; ?>&nbsp;
                                </div>
                                <div class="pret-oferta2" id="pret-oferta">Pret: <?php echo $row['pret']; ?></div>
                                <div class="cantitate-oferta2" id="cantitate-oferta">Cantitate produsa:
                                    <?php echo $row['cantitate']; ?>
                                </div>
                                <div class="timp-oferta2" id="timp-oferta">Publicată pe: &nbsp;<?php echo $row['data']; ?></div>
                                <br>
                                <div class="descriere" id="descriere">Descrierea produsului: <br>
                                    <div class="descriere-casuta"><?php echo $row['descriere']; ?></div>
                                </div>
                                <?php
                                $user_ratings = json_decode($row['user_ratings'], true);
                                $query = "SELECT rating_total, rating_count, user_ratings FROM oferte WHERE id='$id_oferta'";
                                $result = mysqli_query($con2, $query);
                                $rate_users = json_decode($row['rating_users'], true);
                                $is_current_offer_rated = false;
                                $current_user_rating = 0;
                                if (is_array($rate_users) && in_array($nume_utilizator, $rate_users)) {
                                    $is_current_offer_rated = true;
                                    $current_user_rating = $user_ratings[$nume_utilizator];
                                }
                                if (isset($_SESSION['rated_offer_ids'][$id_oferta]) && $_SESSION['rated_offer_ids'][$id_oferta] === true) {
                                    $is_current_offer_rated = true;
                                    $current_user_rating = $user_ratings[$nume_utilizator];
                                }
                                if ($is_current_offer_rated === false) {
                                    ?>
                                    <div class="review" id="review">
                                        <form method="post" action="submit_review.php">
                                            <div class="stele">
                                                <div class="star-rating">
                                                    <input type="radio" id="5-stars" name="rating" value="5">
                                                    <label for="5-stars" class="star">★</label>

                                                    <input type="radio" id="4-stars" name="rating" value="4">
                                                    <label for="4-stars" class="star">★</label>

                                                    <input type="radio" id="3-stars" name="rating" value="3">
                                                    <label for="3-stars" class="star">★</label>

                                                    <input type="radio" id="2-stars" name="rating" value="2">
                                                    <label for="2-stars" class="star">★</label>

                                                    <input type="radio" id="1-star" name="rating" value="1">
                                                    <label for="1-star" class="star">★</label>
                                                </div>
                                                <input type="hidden" name="offer_id" value="<?php echo $id_oferta; ?>">
                                                <div class="buoton">
                                                    <button type="submit" class="oferte">Adaugă o recenzie</button>
                                                </div>
                                        </form>
                                    <?php } else { ?>
                                        <div class="titl">Rating-ul tău: &nbsp;
                                        </div>
                                    </div>
                                    <div class="stele">
                                        <div class="star-rating">
                                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                                <input type="radio" id="<?php echo $i; ?>-stars" name="rating" value="<?php echo $i; ?>"
                                                    <?php echo ($current_user_rating == $i) ? 'checked' : ''; ?> disabled>
                                                <label for="<?php echo $i; ?>-stars" class="star2">★</label>
                                            <?php endfor; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="media">
                                        Media recenziilor: &nbsp;
                                        <?php
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