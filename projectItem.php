<?php
$en_select = "";
$fr_select = "";
if (isset($_GET['lang']) && $_GET['lang'] == 'en' || !isset($_GET['lang'])) {
  require_once './assets/locales/en.php';
  $en_select = "selected";
} else {
  require_once './assets/locales/fr.php';
  $fr_select = "selected";
}

include __DIR__ . '/./assets/models/Projects.php';

$projectId = $_GET["id"];
$projects = new Projects();
$project = $projects->getProject(intval($projectId));

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <?php require_once "./assets/templates/head.php" ?>
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/project-item.css" />
  <link rel="stylesheet" href="assets/css/form-item.css" />
  <title>Un projet</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php
    include './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <article id="home">
      <img src="./assets/images/projects/<?= $project["imageName"] ?>" alt="">
      <h1><?= $project["title"] ?></h1>
      <p><?= $project["description"] ?></p>
    </article>
    <h2><?= $trad["form-item"]["h2"] ?></h2>
    <form class="form-item" action="/assets/php/getComment.php" method="get">
      <div class="form-control">
        <label for="pseudo-name"><?= $trad["form-item"]["labelPseudo"] ?></label>
        <input type="text" name="pseudo-name" id="pseudo-name" placeholder="Pseudo" />
        <i class="mdi mdi-check-circle-outline"></i>
        <i class="mdi mdi-alert-circle"></i>
        <small>Error message</small>
      </div>


      <div class="form-control">
        <label for="user-msg"><?= $trad["form-item"]["labelComment"] ?></label>
        <textarea name="user-msg" id="user-msg" cols="30" rows="9" placeholder="<?= $trad["form-item"]["commentPlaceholder"] ?>"></textarea>
        <small>Error message</small>
      </div>
      <small><?= $trad["form-item"]["SuccessNotification"] ?></small>
      <button><?= $trad["form-item"]["submitBtn"] ?></button>
    </form>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>

  <script src="./assets/js/comment.js" type="module"></script>
  <script src="./assets/js/shared-js.js?parent=projectItem.php"></script>
  <script src="./assets/js/main.js"></script>
</body>

</html>