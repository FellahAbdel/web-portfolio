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
  require_once __DIR__ . '/../assets/locales/en.php';
} else {
  require_once __DIR__ . '/../assets/locales/fr.php';
}

$button = "upload button";
$fileHandler = "insert.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once __DIR__ . '/../assets/templates/head.php'
  ?>
  <link rel="stylesheet" href="/assets/css/shared.css" />
  <link rel="stylesheet" href="/assets/css/form-item.css" />
  <link rel="stylesheet" href="/admin/assets/css/project-form.css" />
  <link rel="stylesheet" href="/admin/assets/css/bootstrapp.css" />
  <title>
    <?= $trad["adminPageTitle"]["insert"] ?>
  </title>
</head>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.php">Fellah</a>
    <?php
    require_once __DIR__ . '/../assets/templates/nav.php'
    ?>
  </header>
  <main>
    <h1>
      <?= $trad["adminPageTitle"]["insert"] ?>
    </h1>
    <?php include __DIR__ . '/assets/templates/projectForm.php' ?>
  </main>
  <?php
  require_once __DIR__ . '/../assets/templates/footer.php'
  ?>
  <script src="/assets/js/shared-js.js?parent=admin/insert.php"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/admin/assets/js/formProject.js?fileName=insert" type="module"></script>
</body>

</html>