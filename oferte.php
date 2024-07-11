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
   <title>Oferte</title>
    <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
   <link rel="stylesheet" href="style/oferte.css">
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
         <span>
            <form id="filter" class="filter-container" action="oferte.php" method="GET"
               onsubmit="return validateForm()">
               <h2>Filtre:</h2>
               <div class="space"><br></div>
               <label for="categorie">Categorie:</label>
               <select id="categorie" name="categorie">
                  <option value="" disabled selected>Alegeți o categorie </option>
                  <option value="Cereale">Cereale</option>
                  <option value="Carne">Carne</option>
                  <option value="Legume">Legume</option>
                  <option value="Lactate">Lactate</option>
                  <option value="Animale">Animale</option>
                  <option value="Fructe">Fructe</option>
                  <option value="Alta categorie">Alta categorie</option>
               </select>
               <div class="space"><br></div>
               <label for="judet">Județ:</label>
               <select id="judet" name="judet">
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
               <div class="space"><br></div>
               <label for="sortare">Sortare după:</label>
               <select id="sortare" name="sortare">
                  <option value="" disabled selected>Selectați o metodă de sortare</option>
                  <option value="data">Data publicării (cel mai nou)</option>
                  <option value="-data">Data publicării (cel mai vechi)</option>
                  <option value="pret">Preț (crescător)</option>
                  <option value="-pret">Preț (descrescător)</option>
               </select>
               <div class="space"><br></div>
               <button class="submit" type="submit">Aplică filtrele</button>
            </form>
            <script>
               function validateForm() {
                  const categorie = document.getElementById('categorie').value;
                  const judet = document.getElementById('judet').value;
                  const sortare = document.getElementById('sortare').value;

                  if (categorie === "" && judet === "" && sortare === "") {
                     alert("Trebuie să selectați cel puțin un filtru.");
                     return false;
                  }
                  return true;
               }
            </script>
         </span>
         <?php
         if (isset($_GET['search_query']) || isset($_GET['categorie']) || isset($_GET['judet']) || isset($_GET['sortare'])) {
            $query = "SELECT * FROM oferte WHERE nume_utilizator != '$current_user_name' AND NOT JSON_CONTAINS(report_users, '\"$current_user_name\"', '$')";
            if (isset($_GET['search_query'])) {
               $search_query = $_GET['search_query'];
               $query .= " AND name LIKE '%$search_query%'";
            }
            if (isset($_GET['categorie'])) {
               $categorie = $_GET['categorie'];
               $query .= " AND categorie = '$categorie'";
            }
            if (isset($_GET['judet'])) {
               $judet = $_GET['judet'];
               $query .= " AND judet = '$judet'";
            }
            if (isset($_GET['sortare'])) {
               $sortare = $_GET['sortare'];
               $query .= " ORDER BY ";
               switch ($sortare) {
                  case 'data':
                     $query .= "data DESC";
                     break;
                  case '-data':
                     $query .= "data ASC";
                     break;
                  case 'pret':
                     $query .= "CAST(SUBSTRING_INDEX(pret, ' ', 1) AS UNSIGNED) ASC";
                     break;
                  case '-pret':
                     $query .= "CAST(SUBSTRING_INDEX(pret, ' ', 1) AS UNSIGNED) DESC";
                     break;
                  default:
                     $query .= "data DESC";
               }
            }
            $result = mysqli_query($con2, $query);
            $num_results = mysqli_num_rows($result);

            if ($num_results > 0) {
               echo "<h2><br>Am găsit $num_results ";
               echo ($num_results == 1) ? "rezultat" : "rezultate";
               echo " pentru tine </h2>";
               while ($row = mysqli_fetch_assoc($result)) { ?>
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
                              pe:&nbsp;<?php echo $row['data'] ?>
                           </div>
                        </div>
                     </div>
                  </a>
                  <?php
               }
            } else {
               echo "<p style=\"font-size:35px; margin-top:200px;margin-bottom:200px;\">Nu există oferte disponibile.</p>";
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