<?php
session_start();
include ("db.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM form WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
         $profileImage = $row['image'];
        $imageSrc = !empty($profileImage) ? 'data:image/jpeg;base64,' . base64_encode($profileImage) : 'imagini/profile.jpg';
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <title>Profil tău</title>
            <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
            <link rel="stylesheet" href="style/profile.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
                integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
                crossorigin="anonymous" />
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
                    <div class="profile">
                        <div class="sus">
                            <div class="welcome">
                                <h1>Bine ai venit, <?php echo $row['name']; ?></h1>
                            </div>
                            <div class="icon-container">
                                <div class="iconu">
                                        <img src="<?php echo htmlspecialchars($imageSrc); ?>" alt="profile image">
                                </div>
                                <a href="imagine.php" class="poza">Editează</a>
                                <div class="laga">
                                    <a href="php/logout.php?logout_id=<?php echo $row['id']; ?>" class="logout-link">
                                        <div class="logout-container">
                                            <i class="fas fa-sign-out-alt logout-icon"></i> Deconectare
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="contact-info">
                                <div class="cont-titlu">CONTACT:</div>
                                <div class="contactes">
                                    <div class="contactee1">
                                        <div class="txtcc">TELEFON:</div>
                                        <a href="tel:<?php echo $row['number']; ?>" class="phone-link">
                                            <span class="phone-text"><?php echo $row['number']; ?></span>
                                        </a>

                                        <div>
                                            <div class="txtcF">FIZIC:</div>
                                            <div class="space"></div>
                                            <div class="locatie">
                                                <i class="fas fa-map-marker-alt location-icon"></i>
                                                <span class="additional-info"><?php echo $row['address']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contactee2">
                                        <div class="txtcc">Mesaj:</div>
                                        <a href="chat.php?user_id=<?php echo $row['id']; ?>" class="mess">
                                        <i class="fas fa-comment"></i>
                                        &nbsp;<?php echo $row['name']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mijloc">
                            <div class="despre">Descrierea ta</div>
                            <div class="descriere">
                                <div id="descrierea" contenteditable="true" class="placeholder"
                                    data-placeholder="Descrierea ta ..." oninput="handleInput()">
                                    <?php echo $row['descriere']; ?>
                                </div>
                            </div>
                            <div class="buttons-container">
                                <button class="edit-button" onclick="editDescription()">Editare</button>
                                <button class="save-button" onclick="saveDescription()">Salvare</button>
                            </div>
                            <form id="editForm" style="display: none;" action="update_description.php" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <textarea id="descriereaInput" name="new_description" style="display: none;"></textarea>
                            </form>
                        </div>

                        <div class="jos">
                            <div class="josel">
                                <a href="oferteta.php" class="oferte">Ofertele tale</a>
                                <a href="oferteraport.php" class="oferte">Oferte raportate</a>
                                <a href="ofertefavorite.php" class="oferte">Oferte favorite</a>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            handleInput();
                        });

                        function handleInput() {
                            var descrierea = document.getElementById("descrierea");
                            var placeholderText = descrierea.getAttribute("data-placeholder");
                            if (descrierea.textContent.trim() === "" || descrierea.textContent.trim() === placeholderText) {
                                descrierea.textContent = placeholderText;
                                descrierea.classList.add("placeholder");
                            }
                        }

                        function editDescription() {
                            var descrierea = document.getElementById("descrierea");
                            var descriereaInput = document.getElementById("descriereaInput");

                            descrierea.textContent = "";

                            descrierea.classList.remove("placeholder");

                            descrierea.setAttribute("contenteditable", "true");

                            descriereaInput.value = descrierea.textContent;

                            descrierea.focus();
                        }

                        function saveDescription() {
                            var descrierea = document.getElementById("descrierea");
                            var descriereaInput = document.getElementById("descriereaInput");

                            descrierea.setAttribute("contenteditable", "false");

                            descriereaInput.value = descrierea.textContent;

                            document.getElementById("editForm").submit();
                        }
                    </script>
                </div>
            </main>
            <script src="script.js"></script>
            <footer>
                <div class="joss">
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

        echo "Nu s-au găsit date pentru utilizatorul curent.";
    }
} else {

    header("Location: login.php");
    exit();
}
?>