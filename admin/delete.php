<?php
$en_select = "";
$fr_select = "";
if (isset($_GET['lang']) && $_GET['lang'] == 'en' || !isset($_GET['lang'])) {
  require_once __DIR__ . '/../assets/locales/en.php';
  $en_select = "selected";
} else {
  require_once __DIR__ . '/../assets/locales/fr.php';
  $fr_select = "selected";
}

if (!empty($_GET["id"])) {
  $projectId = $_GET["id"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once __DIR__ . '/../assets/templates/head.php'
  ?>
  <link rel="stylesheet" href="/assets/css/shared.css" />
  <!-- <link rel="stylesheet" href="/assets/css/form-item.css" /> -->
  <link rel="stylesheet" href="/admin/assets/css/delete.css" />
  <link rel="stylesheet" href="/admin/assets/css/project-form.css" />
  <link rel="stylesheet" href="/admin/assets/css/bootstrapp.css" />
  <title>Delete current project</title>
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
      <?= $trad["adminPageTitle"]["delete"] ?>
    </h1>
    <?php include __DIR__ . '/assets/templates/confirmDelete.php' ?>
  </main>
  <?php
  require_once __DIR__ . '/../assets/templates/footer.php'
  ?>
  <script src="/assets/js/shared-js.js?parent=admin/delete.php"></script>
  <script src="/assets/js/main.js"></script>
</body>

</html>