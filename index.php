<?php

// $body = file_get_contents('php://input');
// $data = json_decode($body, true);
// $lang = isset($data['lang']);

// $lang = $_POST['lang'];

if (isset($_GET['lang']) && $_GET['lang'] == 'en' || !isset($_GET['lang'])) {
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&family=Oleo+Script:wght@700&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <title>fellah's portfolio</title>
</head>

<body>
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
      <ul>
        <?php foreach ($allProject as $project) : ?>
          <?php include __DIR__ . '/assets/templates/article.php' ?>
        <?php endforeach; ?>
      </ul>
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