<?php
session_start();
include "db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mesaje</title>
  <link rel="icon" href="imagini/New Project.png" type="image/x-icon">
  <link rel="stylesheet" href="style/users.css">
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
        <input type="text" id="searchInput" class="top-search-input" name="filter_text"
          placeholder="Caută utilizatori...">
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
      <input type="text" id="searchInput" class="top-search-input" name="filter_text"
        placeholder="Caută utilizatori...">
      <button type="submit" class="top-search-button">
        <i class="fas fa-search"></i>
      </button>
    </form>

    <a href="tutorialUniversal.html"><i class="fas fa-question-circle"></i> Tutorial</a>
    <a href="users.php"><i class="fas fa-comment"></i>&nbsp;Mesaje</a>
    <a href="profile.php"><i class="fas fa-user icon-user"></i> Profil</a>
    <a href="cumparare.php"><i class="fas fa-plus"></i> Adaugă ofertă</a>
  </div>

  <body>
    <main>
      <div class="chats">
        <div class="wrapper">
          <section class="chat-area">
            <div class="contentsus">
              <?php
              $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
              $sql = mysqli_query($con, "SELECT * FROM form WHERE id = {$user_id}");
              if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                 $profileImage = $row['image'];
                 $imageSrc = !empty($profileImage) ? 'data:image/jpeg;base64,' . base64_encode($profileImage) : 'imagini/profile.jpg';
              } else {
                header("location: users.php");
              }
              if($user_id== $_SESSION['user_id'])
              {
                  header("location: users.php");
              }
              ?>
              <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
              <a href="profileview.php?filter_text=<?php echo $row['name']; ?>"
                style="text-decoration:none; color:black;"><img src="<?php echo htmlspecialchars($imageSrc); ?>" alt="profile image"></a>
              <div class="details" style="  margin-top: 15px;">
                <a href="profileview.php?filter_text=<?php echo $row['name']; ?>"
                  style="text-decoration:none; color:black;"><span><?php echo $row['name']; ?></span></a>
                <p style="margin-top:5px;color: #67676a;"><?php echo $row['status']; ?></p>
              </div>
            </div>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
              <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
              <input type="text" name="message" class="input-field" placeholder="Scrie un mesaj aici..."
                autocomplete="off">
              <button><i class="fab fa-telegram-plane"></i></button>
            </form>
          </section>
        </div>
      </div>
      <script src="javascript/chat.js"></script>
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