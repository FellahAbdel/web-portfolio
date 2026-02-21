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

include __DIR__ . '/assets/models/Projects.php';

$projects = new Projects();

// Get parameters
$start = 0;
$count = 3;

// Check if the user is on a mobile device or tablet
if (isset($_SERVER['HTTP_USER_AGENT'])) {
  if (preg_match('/(tablet|ipad|android(?!.*mobile))/i', $_SERVER['HTTP_USER_AGENT'])) {
    $count = 2; // Load 2 projects initially on tablet devices
  } elseif (preg_match('/mobile/i', $_SERVER['HTTP_USER_AGENT'])) {
    $count = 1; // Load 1 project initially on mobile devices
  }
}

$allProject = $projects->getProjectBetween($start, $count);
// header("Content-Type: application/json");
// echo json_encode($projects);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once './assets/templates/head.php'
  ?>
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <title>fellah's portfolio</title>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TLZC5NM8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <header>
    <!--I added this.-->
    <a href="/index.php">Fellah</a>
    <?php
    require_once './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <section>
      <div id="home">
        <?php
        require_once './assets/templates/profile.php'
        ?>
        <?php
        require_once './assets/templates/homeData.php'
        ?>
      </div>
    </section>
    <section id="projects">
      <h2><?= $trad["projectSection"]["title"] ?></h2>
      <ul id="ul" class="projects-grid">
        <?php foreach ($allProject as $project) : ?>
          <?php include __DIR__ . '/assets/templates/projectCard.php' ?>
        <?php endforeach; ?>
      </ul>
      <button><?= $trad["index"]["load"] ?></button>
    </section>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>
  <script src="./assets/js/shared-js.js?parent=index.php"></script>
  <script src="./assets/js/ajax.js"></script>
  <script src="./assets/js/main.js"></script>
</body>

</html>
