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

$cv = $trad['cv'];
?>

<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">

<head>
  <?php require_once './assets/templates/head.php' ?>
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/cv.css" />
  <title>CV | Abdoul Aziz DIALLO</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php require_once './assets/templates/nav.php' ?>
  </header>

  <main class="cv-container">
    <section class="cv-header">
      <h1>Abdoul Aziz DIALLO</h1>
      <p class="subtitle"><?= $cv['title'] ?></p>
      <div class="info-grid">
        <span><i class="mdi mdi-calendar"></i> <?= $cv['availability'] ?></span>
        <span><i class="mdi mdi-map-marker"></i> <?= $cv['location'] ?></span>
        <span><i class="mdi mdi-car"></i> <?= $cv['license'] ?></span>
      </div>
    </section>

    <section class="cv-intro">
      <p><?= $cv['intro'] ?></p>
    </section>

    <!-- Skills Section -->
    <section class="cv-section reveal">
      <h2><?= $cv['sections']['skills'] ?></h2>
      <div class="skills-grid">
        <div class="skill-card">
          <h3><?= $cv['hard_skills']['title'] ?></h3>
          <div class="skill-list">
            <?php foreach ($cv['hard_skills']['items'] as $category => $items) : ?>
              <div class="skill-item">
                <strong><?= $category ?> :</strong>
                <span><?= $items ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="skill-card">
          <h3><?= $cv['soft_skills']['title'] ?></h3>
          <ul class="timeline-details">
            <?php foreach ($cv['soft_skills']['items'] as $skill) : ?>
              <li><?= $skill ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </section>

    <!-- Experience Section -->
    <section class="cv-section reveal">
      <h2><?= $cv['sections']['experience'] ?></h2>
      <div class="timeline">
        <?php foreach ($cv['experiences'] as $exp) : ?>
          <div class="timeline-item">
            <div class="timeline-content">
              <span class="timeline-period"><?= $exp['period'] ?></span>
              <h3 class="timeline-role"><?= $exp['role'] ?></h3>
              <span class="timeline-company"><?= $exp['company'] ?></span>
              <p><?= $exp['description'] ?></p>
              <?php if (isset($exp['details'])) : ?>
                <ul class="timeline-details">
                  <?php foreach ($exp['details'] as $detail) : ?>
                    <li><?= $detail ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
              <?php if (isset($exp['tech'])) : ?>
                <div class="tech-stack">
                  <strong>Technologies :</strong> <?= $exp['tech'] ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Education Section -->
    <section class="cv-section reveal">
      <h2><?= $cv['sections']['education'] ?></h2>
      <div class="timeline">
        <?php foreach ($cv['education'] as $edu) : ?>
          <div class="timeline-item">
            <div class="timeline-content">
              <span class="timeline-period"><?= $edu['period'] ?></span>
              <h3 class="timeline-role"><?= $edu['title'] ?></h3>
              <span class="timeline-company"><?= $edu['institution'] ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Projects Section -->
    <section class="cv-section reveal">
      <h2><?= $cv['sections']['projects'] ?></h2>
      <div class="projects-container">
        <?php foreach ($cv['projects'] as $groupKey => $group) : ?>
          <div class="project-group">
            <h3><?= $group['title'] ?></h3>
            <div class="project-items">
              <?php foreach ($group['items'] as $project) : ?>
                <div class="cv-project-card">
                  <span class="date"><?= $project['date'] ?></span>
                  <h4><?= $project['title'] ?></h4>
                  <p><?= $project['description'] ?></p>
                  <?php if (isset($project['details'])) : ?>
                    <ul class="timeline-details">
                      <?php foreach ($project['details'] as $detail) : ?>
                        <li><?= $detail ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                  <?php if (isset($project['tech'])) : ?>
                    <div class="tech-stack">
                      <strong>Technos :</strong> <?= $project['tech'] ?>
                    </div>
                  <?php endif; ?>
                  <?php if (isset($project['tools'])) : ?>
                    <div class="tech-stack">
                      <strong>Outils :</strong> <?= $project['tools'] ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Languages & Interests -->
    <section class="cv-section reveal">
      <h2><?= $cv['sections']['languages'] ?></h2>
      <div class="skills-grid">
        <div class="skill-card">
          <div class="skill-list">
            <?php foreach ($cv['languages']['items'] as $lang => $level) : ?>
              <div class="skill-item">
                <strong><?= $lang ?> :</strong>
                <span><?= $level ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="skill-card">
          <h3><?= $cv['interests']['title'] ?></h3>
          <p><?= implode(', ', $cv['interests']['items']) ?></p>
        </div>
      </div>
    </section>

  </main>

  <?php require_once './assets/templates/footer.php' ?>
  <script src="./assets/js/shared-js.js?parent=cv.php"></script>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/reveal.js"></script>
  <script src="./assets/js/theme.js"></script>
</body>

</html>
