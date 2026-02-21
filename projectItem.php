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

include __DIR__ . '/./assets/models/Projects.php';

if (!empty($_GET["id"])) {
  $projectId = checkInput($_GET["id"]);
  $projects = new Projects();
  $project = $projects->getProject(intval($projectId));
}

function checkInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <?php require_once "./assets/templates/head.php" ?>
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/project-item.css" />
  <link rel="stylesheet" href="assets/css/form-item.css" />

  <title><?= $project["title"] ?> - Fellah</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php
    include './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <article class="project-detail">
      <div class="project-header">
        <h1><?= $project["title"] ?></h1>
        <div class="project-meta">
          <!-- Placeholder pour la date ou catégorie si dispo -->
          <span class="meta-item"><i class="mdi mdi-calendar"></i> 2024</span>
          <span class="meta-item"><i class="mdi mdi-tag"></i> Web Development</span>
        </div>
      </div>

      <div class="project-hero-image">
        <img src="/public/uploads/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>">
      </div>
      
      <div class="project-body">
        <div class="project-description">
          <?= htmlspecialchars_decode($project["description"]) ?>
        </div>
        
        <!-- Sidebar ou Infos supplémentaires (Optionnel) -->
        <div class="project-sidebar">
          <h3>Technologies</h3>
          <div class="tech-stack">
            <span class="tag">PHP</span>
            <span class="tag">MySQL</span>
            <span class="tag">JavaScript</span>
            <span class="tag">CSS3</span>
          </div>
          
          <div class="project-actions">
             <a href="/index.php" class="btn-back"><i class="mdi mdi-arrow-left"></i> <?= $trad["AdminProjectForm"]["go-back-btn"] ?></a>
          </div>
        </div>
      </div>
    </article>

    <!-- Section Commentaires (Redesignée) -->
    <section class="comments-section">
      <div class="comments-container">
        <h2><?= $trad["form-item"]["h2"] ?></h2>
        <form class="form-item" action="/assets/php/getComment.php" method="get">
          <div class="form-control">
            <label for="pseudo-name"><?= $trad["form-item"]["labelPseudo"] ?></label>
            <input type="text" name="pseudo-name" id="pseudo-name" placeholder="Votre pseudo" />
            <i class="mdi mdi-check-circle-outline"></i>
            <i class="mdi mdi-alert-circle"></i>
            <small>Error message</small>
          </div>
          <div class="form-control">
            <label for="user-msg"><?= $trad["form-item"]["labelComment"] ?></label>
            <textarea name="user-msg" id="user-msg" cols="30" rows="5" placeholder="<?= $trad["form-item"]["commentPlaceholder"] ?>"></textarea>
            <small>Error message</small>
          </div>
          <small class="success-msg"><?= $trad["form-item"]["SuccessNotification"] ?></small>
          <button type="submit" class="btn-submit"><?= $trad["form-item"]["submitBtn"] ?></button>
        </form>
      </div>
    </section>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>

  <script src="./assets/js/comment.js" type="module"></script>
  <script src="./assets/js/shared-js.js?parent=projectItem.php"></script>
  <script src="./assets/js/main.js"></script>
</body>

</html>