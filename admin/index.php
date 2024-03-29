<?php
// $en_select = "";
// $fr_select = "";
// if (isset($_GET['lang']) && $_GET['lang'] == 'en' || !isset($_GET['lang'])) {
//   require_once __DIR__ . '/../assets/locales/en.php';
//   $en_select = "selected";
// } else {
//   require_once __DIR__ . '/../../assets/locales/fr.php';
//   $fr_select = "selected";
// }

session_start();

if (isset($_GET['lang']) && ($_GET['lang'] == 'en' || $_GET['lang'] == 'fr')) {
  $_SESSION['lang'] = $_GET['lang'];
} elseif (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = 'en'; // Default language
}

$en_select = ($_SESSION['lang'] == 'en') ? "selected" : "";
$fr_select = ($_SESSION['lang'] == 'fr') ? "selected" : "";

if ($_SESSION['lang'] == 'en') {
  require_once __DIR__ . '/../assets/locales/en.php';
} else {
  require_once __DIR__ . '/../assets/locales/fr.php';
}

include __DIR__ . '/../assets/models/Projects.php';
// var_dump(__DIR__ . '/../assets/models/Projects.php');
$projects = new Projects();

$allProject = $projects->getProjects();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once '../assets/templates/head.php'
  ?>
  <link rel="stylesheet" href="../assets/css/shared.css" />
  <link rel="stylesheet" href="./assets/css/styles.css" />
  <link rel="stylesheet" href="/admin/assets/css/bootstrapp.css" />
  <title>fellah's portfolio</title>
</head>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.php">Fellah</a>
    <?php
    require_once '../assets/templates/nav.php'
    ?>
  </header>
  <main>
    <section id="projects">
      <h2><strong> <?= $trad["adminProjectSection"]["h2"] ?></strong>
        <a href="/admin/insert.php" class="btn btn-success btn-lg">
          <span class="mdi mdi-plus"><?= $trad["adminProjectSection"]["add"] ?></span>
        </a>
      </h2>
      <ul>
        <?php foreach ($allProject as $project) : ?>
          <?php include __DIR__ . '/assets/templates/article.php' ?>
        <?php endforeach; ?>
      </ul>
    </section>
  </main>
  <?php
  require_once '../assets/templates/footer.php'
  ?>
  <script src="/assets/js/shared-js.js?parent=index.php"></script>
  <script src="/assets/js/main.js"></script>
</body>

</html>