<?php
session_start();

if (isset($_GET['lang']) && ($_GET['lang'] == 'en' || $_GET['lang'] == 'fr')) {
  $_SESSION['lang'] = $_GET['lang'];
} elseif (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = 'fr'; // Langue par défaut en admin
}

$en_select = ($_SESSION['lang'] == 'en') ? "selected" : "";
$fr_select = ($_SESSION['lang'] == 'fr') ? "selected" : "";

if ($_SESSION['lang'] == 'en') {
  require_once __DIR__ . '/../assets/locales/en.php';
} else {
  require_once __DIR__ . '/../assets/locales/fr.php';
}

require_once __DIR__ . '/../assets/models/Projects.php';
require_once __DIR__ . '/../assets/models/Contact.php';

$projects = new Projects();
$allProject = $projects->getProjects();

$contact = new Contact();
$unreadMessagesCount = $contact->getUnreadCount();
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['lang'] ?? 'fr') ?>">

<head>
  <?php require_once '../assets/templates/head.php' ?>
  <link rel="stylesheet" href="../assets/css/shared.css" />
  <link rel="stylesheet" href="./assets/css/styles.css" />
  <link rel="stylesheet" href="./assets/css/messages.css" />
  <link rel="stylesheet" href="/admin/assets/css/bootstrapp.css" />
  <title><?= ($_SESSION['lang'] == 'en') ? 'Projects Admin' : 'Administration des Projets' ?> - Fellah</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php require_once '../assets/templates/nav.php' ?>
  </header>
  <main>
    <div class="admin-container">
      <!-- Navigation Admin -->
      <div class="admin-subnav">
        <a href="/admin/index.php" class="admin-tab active">
          <i class="mdi mdi-view-grid-outline"></i>
          <span><?= ($_SESSION['lang'] == 'en') ? 'Projects' : 'Projets' ?></span>
        </a>
        <a href="/admin/messages.php" class="admin-tab">
          <i class="mdi mdi-email-outline"></i>
          <span><?= ($_SESSION['lang'] == 'en') ? 'Messages' : 'Messages de contact' ?></span>
          <span class="tab-badge <?= ($unreadMessagesCount > 0) ? '' : 'hidden' ?>"><?= $unreadMessagesCount ?></span>
        </a>
      </div>

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
    </div>
  </main>
  <?php require_once '../assets/templates/footer.php' ?>
  <script src="/assets/js/shared-js.js?parent=index.php"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/theme.js"></script>
  <script src="/assets/js/custom-select.js"></script>
</body>

</html>