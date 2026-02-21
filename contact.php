<?php
session_start();

if (isset($_GET['lang']) && ($_GET['lang'] == 'en' || $_GET['lang'] == 'fr')) {
  $_SESSION['lang'] = $_GET['lang'];
} elseif (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = 'en'; // Default language
}

$en_select = ($_SESSION['lang'] == 'en') ? "selected" : "";
$fr_select = ($_SESSION['lang'] == 'fr') ? "selected" : "";

if ($_SESSION['lang'] == 'en') {
  require_once './assets/locales/en.php';
} else {
  require_once './assets/locales/fr.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once './assets/templates/head.php'
  ?>
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/contact.css" />
  <title>Contact - Fellah</title>
</head>


<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php
    include './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <div class="contact-container">
      <div class="contact-grid">
        <!-- Section Infos (Gauche) -->
        <section class="contact-info">
          <h2><?= $trad["contact-first-section"]["h2"] ?></h2>
          <p class="contact-intro">
            <?= $trad["contact-first-section"]["p"] ?>
          </p>
          
          <ul class="info-list">
            <li class="info-item">
              <div class="icon-box">
                <i class="mdi mdi-email-outline"></i>
              </div>
              <div class="info-content">
                <h3><?= $trad["contact-first-section"]["div1 h3"] ?></h3>
                <p><?= $trad["contact-first-section"]["div1 p1"] ?></p>
                <a href="mailto:<?= $trad["contact-first-section"]["div1 p2"] ?>" class="link-text"><?= $trad["contact-first-section"]["div1 p2"] ?></a>
              </div>
            </li>
            
            <li class="info-item">
              <div class="icon-box">
                <i class="mdi mdi-map-marker-outline"></i>
              </div>
              <div class="info-content">
                <h3><?= $trad["contact-first-section"]["div2 h3"] ?></h3>
                <p><?= $trad["contact-first-section"]["div2 p1"] ?></p>
                <p class="sub-text"><?= $trad["contact-first-section"]["div2 p2"] ?></p>
              </div>
            </li>
            
            <li class="info-item">
              <div class="icon-box">
                <i class="mdi mdi-phone-outline"></i>
              </div>
              <div class="info-content">
                <h3><?= $trad["contact-first-section"]["div3 h3"] ?></h3>
                <p><?= $trad["contact-first-section"]["div3 p1"] ?></p>
                <a href="tel:<?= str_replace(' ', '', $trad["contact-first-section"]["div3 p2"]) ?>" class="link-text"><?= $trad["contact-first-section"]["div3 p2"] ?></a>
              </div>
            </li>
          </ul>
        </section>

        <!-- Section Formulaire (Droite) -->
        <section class="contact-form-wrapper">
          <div class="form-header">
            <h1><?= $trad["contact-second-section"]["h1"] ?></h1>
            <p><?= $trad["contact-second-section"]["p"] ?></p>
          </div>
          
          <?php require_once './assets/templates/form.php' ?>
        </section>
      </div>
    </div>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/shared-js.js?parent=contact.php"></script>
  <script src="./assets/js/contact.js" type="module"></script>
</body>

</html>