<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ok = true;
    $password = $_POST["pass"];
    $address = $_POST["add"];
    $user_name = $_POST["name"];
    $gmail = $_POST["email"];
    $num = $_POST["number"];

    if (strlen($password) < 8) {
        $errors['password'] = 'Parola trebuie să aibă minim 8 caractere.';
        $ok = false;
    }
    if (!preg_match("/[a-z]/i", $password)) {
        $errors['password'] = 'Parola trebuie să conțină minim o literă.';
        $ok = false;
    }
    if (!preg_match("/[0-9]/i", $password)) {
        $errors['password'] = 'Parola trebuie să conțină minim o cifră.';
        $ok = false;
    }

    if ($ok) {
        // Check email
        $stmt = $con->prepare("SELECT * FROM form WHERE email=?");
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $stmt->store_result(); 
        if ($stmt->num_rows > 0) {
            $errors['email'] = 'Email-ul este deja utilizat.';
            $ok = false;
        }
        $stmt->close();

        $stmt = $con->prepare("SELECT * FROM form WHERE number=?");
        $stmt->bind_param("s", $num);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors['number'] = 'Numărul de telefon este deja utilizat.';
            $ok = false;
        }
        $stmt->close();

        $stmt = $con->prepare("SELECT * FROM form WHERE name=?");
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $stmt->store_result(); 
        if ($stmt->num_rows > 0) {
            $errors['username'] = 'Numele de utilizator este deja utilizat.';
            $ok = false;
        }
        $stmt->close();

        if ($ok) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            date_default_timezone_set("Europe/Bucharest");
            $currentDateTime = date('Y-m-d H:i:s');

            $stmt = $con->prepare("INSERT INTO form (address, name, email, number, pass, data) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $address, $user_name, $gmail, $num, $hashed_password, $currentDateTime);
            
            if ($stmt->execute()) {
                 echo "<script>
                        alert('Înregistrare reușită, vă rugăm logați-vă');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Eroare la înregistrare.');</script>";
            }
            $stmt->close();
            mysqli_stmt_close($stmt);
            mysqli_close($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>Înregistrare</title>
      <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
      <link rel="stylesheet" href="style/stylesign.css">
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
          <div class="dropdown-menu">
             <form action="oferte.php" method="GET" id="dropdownProductSearchForm">
                <div class="top-search-container2">
                   <input type="text" class="top-search-input2" name="search_query" placeholder="Caută produse...">
                   <button type="submit" class="top-search-button2">
                   <i class="fas fa-search"></i>
                   </button>
                </div>
             </form>
             <form id="dropdownUserSearchForm" action="profiles.php" method="GET" class="top-search-container">
                <input type="text" id="dropdownUserSearchInput" class="top-search-input" name="filter_text"
                   placeholder="Caută utilizatori...">
                <button type="submit" class="top-search-button">
                <i class="fas fa-search"></i>
                </button>
             </form>
             <a href="tutorialUniversal.html"><i class="fas fa-question-circle"></i> Tutorial</a>
             <a href="profile.php"><i class="fas fa-user icon-user"></i> Profil</a>
             <a href="cumparare.php"><i class="fas fa-plus"></i> Adaugă ofertă</a>
          </div>
      <main>
         <div class="chenar">
            <form method="post" class="formaa">
               <div class="inregistrare">
                  <h1 class="txt">Înregistrare</h1>
                  <div class="text-box">
                     <label for="add">Selectați județul de domiciliu:</label>
                     <select id="add" name="add" required>
                        <option value="" disabled selected>Selectați un județ </option>
                        <option value="Alba">Alba</option>
                        <option value="Arad">Arad</option>
                        <option value="Arges">Arges</option>
                        <option value="Bacau">Bacau</option>
                        <option value="Bihor">Bihor</option>
                        <option value="Bistrita-Nasaud">Bistrita-Nasaud</option>
                        <option value="Botosani">Botosani</option>
                        <option value="Brasov">Brasov</option>
                        <option value="Braila">Braila</option>
                        <option value="Buzau">Buzau</option>
                        <option value="Caras-Severin">Caras-Severin</option>
                        <option value="Calarasi">Calarasi</option>
                        <option value="Cluj">Cluj</option>
                        <option value="Constanta">Constanta</option>
                        <option value="Covasna">Covasna</option>
                        <option value="Dambovita">Dambovita</option>
                        <option value="Dolj">Dolj</option>
                        <option value="Galati">Galati</option>
                        <option value="Giurgiu">Giurgiu</option>
                        <option value="Gorj">Gorj</option>
                        <option value="Harghita">Harghita</option>
                        <option value="Hunedoara">Hunedoara</option>
                        <option value="Ialomita">Ialomita</option>
                        <option value="Iasi">Iasi</option>
                        <option value="Ilfov">Ilfov</option>
                        <option value="Maramures">Maramures</option>
                        <option value="Mehedinti">Mehedinti</option>
                        <option value="Mures">Mures</option>
                        <option value="Neamt">Neamt</option>
                        <option value="Olt">Olt</option>
                        <option value="Prahova">Prahova</option>
                        <option value="Satu Mare">Satu Mare</option>
                        <option value="Salaj">Salaj</option>
                        <option value="Sibiu">Sibiu</option>
                        <option value="Suceava">Suceava</option>
                        <option value="Teleorman">Teleorman</option>
                        <option value="Timis">Timis</option>
                        <option value="Tulcea">Tulcea</option>
                        <option value="Vaslui">Vaslui</option>
                        <option value="Valcea">Valcea</option>
                        <option value="Vrancea">Vrancea</option>
                     </select>
                  </div>
                  <div class="text-box">
                     <input type="text" id="name" placeholder="Nume de utilizator" name="name" required>
                  </div>
                  <div class="text-box">
                     <input type="email" id="email" placeholder="Email" name="email" required>
                  </div>
                  <div class="text-box">
                     <input type="tel" id="number" placeholder="Număr de telefon (10 cifre)" name="number"
                        pattern="[0-9]{10}" title="Introduceți un număr de telefon valid format din 10 cifre"
                        required>
                  </div>
                  <div class="text-box">
                     <input type="password" id="pass" placeholder="Parolă" name="pass"
                        title="Parola trebuie să conțină minim 8 caractere și cel puțin o cifră." required>
                  </div>
                  <div class="buoton">
                     <input type="submit" value="Înregistrare" id="submit" class="sign-btn" name="sign_Btn" required>
                  </div>
                  <div class="signup">
                     Ai deja cont făcut?
                     <br>
                     <a href="login.php">Loghează-te</a>
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
