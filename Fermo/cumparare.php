<?php
include ("db.php");
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $query = "SELECT name FROM form WHERE id = '$user_id'";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['name'];
  }
  $query = "SELECT number FROM form WHERE id = '$user_id'";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $num = $row['number'];
  }
  $query = "SELECT email FROM form WHERE id = '$user_id'";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
  }
}
else {
  header("Location: login.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $productName = $_POST["productName"];
  $productLocation = $_POST["productLocation"];
  $ownerLocation = $_POST["ownerLocation"];
  $productPrice = $_POST["productPrice"];
  $productQuantity = $_POST["productQuantity"];
  $productDescription = $_POST["productDescription"];
  date_default_timezone_set("Europe/Bucharest");
  $currentDateTime = date('Y-m-d H:i:s');
  $imagine = $_FILES["productImage"]["tmp_name"];
  $productCateogry = $_POST["productCateogry"];

 if(!empty($imagine)) {
    $imgData = addslashes(file_get_contents($imagine));
    $insert_query = "INSERT INTO oferte (name,categorie, judet, address,imagine,pret, cantitate,nume_utilizator,descriere,data,email,number) VALUES ('$productName','$productCateogry', '$productLocation', '$ownerLocation','$imgData', '$productPrice', '$productQuantity','$username','$productDescription','$currentDateTime','$email','$num')";
    if (mysqli_query($con2, $insert_query)) {
      header("Location: profile.php");
      exit();
    } else {
      echo "<script>alert('Eroare: " . mysqli_error($con2) . "');</script>";
    }
  }
}
echo '<link rel="shortcut icon" href="New Project.ico" type="image/x-icon" />';
?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Fermo</title>
             <link rel="icon" href=
        "New Project.ico"
                  type="image/x-icon">
          <link rel="stylesheet" href="style/cumparare.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
          <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
</head>
<body>
  <header>
    <!--Sticky menu-->
    <div class="navbar">
       <a href="index.html">
            <img src="imagini/gugug.png" alt="Descrierea imaginii" class="titlu">
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
  <br>
  <br>
  <main>
  <form action="cumparare.php" method="POST" enctype="multipart/form-data">
    <div class="product-form">
      <div class="product-title">Adaugă o ofertă nouă</div>
      <label for="productImage">Imagine produs:</label>
      <input type="file" id="productImage" class="prodimg" name="productImage" required>

      <label for="productName">Nume produs:</label>
      <input type="text" id="productName" name="productName" placeholder="Introduceți numele produsului" required>

      <label for="productLocation">Selectați județul în care vreți să vindeți produsul:</label>
      <select id="productLocation" name="productLocation" class=" judetl" required>
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
      </select>
     <label for="productCateogry">Selectați cateogria din care face parte produsul:</label>
      <select id="productCateogry" name="productCateogry" class=" judetl" required>
         <option value="" disabled selected>Selectați o categorie </option>
                        <option value="Cereale">Cereale</option>
                        <option value="Lactate">Lactate</option>
                        <option value="Fructe">Fructe</option>
                        <option value="Legume">Legume</option>
                        <option value="Carne">Carne</option>
                        <option value="Animale">Animale</option>
                        <option value="Alta cateogire">Alta categorie</option>
                        
        </select>
      <label for="ownerLocation">Locația dvs:</label>
      <input type="text" id="ownerLocation" name="ownerLocation" placeholder="Introduceți localitatea de domiciliu">

      <label for="productPrice">Preț ofertă:</label>
      <input type="text" id="productPrice" name="productPrice" placeholder="Introduceți prețul ofertei  (EX: RON/L, RON/BUC, RON/Kg)" required>

      <label for="productQuantity">Cantitate disponibilă:</label>
      <input type="text" id="productQuantity" name="productQuantity" placeholder="Introduceți cantitatea disponibilă (EX: L, BUC, Kg)"
        required>

      <label for="productDescription">Descriere produs:</label>
      <input type="text" id="productDescription" name="productDescription" placeholder="Adăugați descrierea produsului"
        required>
      <button type="submit" class="prod-buton">Adaugă produs</button>
      <div class="notice"> Oferta nu se va putea edita ulterior!</div>
    </div>
  </form>
  </div>
    </main>
  <footer>
    <div>
      <h2><strong class="contact-heading">Contactați-ne:</strong>
        <i class="far fa-envelope envelope-icon"></i> <a href="mailto:fermo.contact@gmail.com" class="email-link"><span
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