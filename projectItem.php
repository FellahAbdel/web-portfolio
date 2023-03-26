<?php
require_once './assets/locales/en.php';
include __DIR__ . '/./assets/models/Projects.php';

$projectId = $_GET["id"];
$projects = new Projects();
$project = $projects->getProject(intval($projectId));

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&family=Roboto:wght@700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&family=Oleo+Script:wght@700&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/project-item.css" />
  <title>fellah's portfolio</title>
</head>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.html">Fellah</a>
    <?php
    include './assets/locales/en.php';
    include './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <article id="home">
      <img src="./assets/images/projects/<?= $project["imageName"] ?>" alt="">
      <h1><?= $project["title"] ?></h1>
      <p><?= $project["description"] ?></p>
    </article>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>
  <script src="./assets/js/main.js"></script>
</body>

</html>