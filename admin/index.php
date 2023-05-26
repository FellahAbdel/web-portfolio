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
        <a href="insert.php" class="btn btn-success btn-lg">
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