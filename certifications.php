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

$certsPage = $trad['certifications_page'];
?>

<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">

<head>
  <?php require_once './assets/templates/head.php' ?>
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/certifications.css" />
  <title>Certifications | Abdoul Aziz DIALLO</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php require_once './assets/templates/nav.php' ?>
  </header>

  <main class="cert-container">
    <section class="cert-header reveal">
      <div class="cert-badge-top">
        <i class="mdi mdi-certificate"></i>
        <span><?= $certsPage['badge'] ?></span>
      </div>
      <h1><?= $certsPage['title'] ?></h1>
      <p class="subtitle"><?= $certsPage['subtitle'] ?></p>
    </section>

    <!-- Controls Bar: Filter pills & View mode switcher -->
    <div class="cert-controls reveal">
      <div class="cert-filters" role="tablist">
        <button class="filter-btn active" data-filter="all"><?= $certsPage['filter_all'] ?></button>
        <button class="filter-btn" data-filter="web"><?= $certsPage['filter_web'] ?></button>
        <button class="filter-btn" data-filter="devops"><?= $certsPage['filter_devops'] ?></button>
        <button class="filter-btn" data-filter="lang"><?= $certsPage['filter_lang'] ?></button>
      </div>

      <div class="view-switcher">
        <button class="view-btn active" id="view-timeline-btn" aria-label="Mode Timeline">
          <i class="mdi mdi-timeline-text-outline"></i>
          <span><?= $certsPage['view_timeline'] ?></span>
        </button>
        <button class="view-btn" id="view-grid-btn" aria-label="Mode Grille">
          <i class="mdi mdi-grid-large"></i>
          <span><?= $certsPage['view_grid'] ?></span>
        </button>
      </div>
    </div>

    <!-- Timeline & Cards Container -->
    <div class="cert-timeline-wrapper" id="cert-wrapper">
      <div class="cert-timeline" id="cert-timeline">
        <?php foreach ($certsPage['list'] as $cert) : ?>
          <article class="cert-item reveal" data-category="<?= $cert['category'] ?>">
            <div class="cert-node" aria-hidden="true"></div>
            <div class="cert-card">
              
              <!-- Certification PNG Logo Visual -->
              <div class="cert-image-container">
                <img src="<?= htmlspecialchars($cert['image']) ?>" alt="<?= htmlspecialchars($cert['title']) ?>" loading="lazy" />
              </div>

              <!-- Content details -->
              <div class="cert-content">
                <div>
                  <div class="cert-meta-header">
                    <div class="cert-title-group">
                      <h2><?= htmlspecialchars($cert['title']) ?></h2>
                      <div class="cert-issuer">
                        <i class="mdi mdi-office-building"></i>
                        <span><?= htmlspecialchars($cert['issuer']) ?></span>
                      </div>
                    </div>
                    <span class="cert-date-badge">
                      <i class="mdi mdi-calendar-check"></i>
                      <?= htmlspecialchars($cert['date']) ?>
                    </span>
                  </div>

                  <p class="cert-description"><?= htmlspecialchars($cert['description']) ?></p>
                </div>

                <div>
                  <!-- Skills badges -->
                  <div class="cert-skills">
                    <?php foreach ($cert['skills'] as $skill) : ?>
                      <span class="tag"><?= htmlspecialchars($skill) ?></span>
                    <?php endforeach; ?>
                  </div>

                  <!-- Footer row: ID & Verification link -->
                  <div class="cert-footer-row">
                    <span class="cert-id-tag">
                      <i class="mdi mdi-shield-check-outline"></i>
                      ID: <?= htmlspecialchars($cert['credential_id']) ?>
                    </span>
                    <?php if (isset($cert['verify_url'])) : ?>
                      <a href="<?= htmlspecialchars($cert['verify_url']) ?>" target="_blank" rel="noopener noreferrer" class="cert-verify-link">
                        <span><?= $certsPage['verify_button'] ?></span>
                        <i class="mdi mdi-open-in-new"></i>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>

              </div>

            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </main>

  <?php require_once './assets/templates/footer.php' ?>

  <script src="./assets/js/shared-js.js?parent=certifications.php"></script>
  <script src="./assets/js/main.js"></script>
  <script src="./assets/js/reveal.js"></script>
  <script src="./assets/js/theme.js"></script>
  <script src="./assets/js/custom-select.js"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const filterBtns = document.querySelectorAll('.filter-btn');
      const certItems = document.querySelectorAll('.cert-item');
      const timelineWrapper = document.getElementById('cert-wrapper');
      const viewTimelineBtn = document.getElementById('view-timeline-btn');
      const viewGridBtn = document.getElementById('view-grid-btn');

      // Client-side Filtering
      filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          filterBtns.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');

          const category = btn.getAttribute('data-filter');

          certItems.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
              item.classList.remove('hidden');
            } else {
              item.classList.add('hidden');
            }
          });
        });
      });

      // View Mode Switching (Timeline vs Grid)
      viewTimelineBtn.addEventListener('click', () => {
        viewTimelineBtn.classList.add('active');
        viewGridBtn.classList.remove('active');
        timelineWrapper.classList.remove('cert-grid-mode');
      });

      viewGridBtn.addEventListener('click', () => {
        viewGridBtn.classList.add('active');
        viewTimelineBtn.classList.remove('active');
        timelineWrapper.classList.add('cert-grid-mode');
      });
    });
  </script>
</body>

</html>
