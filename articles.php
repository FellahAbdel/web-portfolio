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

// include __DIR__ . '/assets/models/Articles.php';
// $articlesModel = new Articles();
// $articles = $articlesModel->getArticles();

// Article statique pour le moment
$articles = [
  [
    'id' => 1,
    'title' => "Du Java au Python : Quand Spring Boot rencontre FastAPI",
    'created_at' => "2026-02-19 14:00:00",
    'imageName' => "python-java.jpeg", // Image placeholder ou à uploader
    'imageAlt' => "Java vs Python",
    'content' => "Le 19 février 2026, j'ai assisté à une présentation technique captivante animée par Paul, ingénieur logiciel et ancien \"Javaïste\" convaincu. Son défi ? Démontrer comment l'écosystème Python, souvent perçu comme le terrain de jeu des Data Scientists, peut répondre aux exigences d'industrialisation des développeurs Java."
  ]
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once './assets/templates/head.php'
  ?>
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <link rel="stylesheet" href="assets/css/articles.css" />
  <title>fellah's portfolio - Articles</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php
    require_once './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <section id="articles-list">
      <h2><?= $trad["nav"]["articles"] ?></h2>
      <div class="articles-container">
        <?php if (empty($articles)) : ?>
          <p><?= $trad["articles"]["no_articles"] ?? "Aucun article pour le moment." ?></p>
        <?php else : ?>
          <?php foreach ($articles as $article) : ?>
            <article class="article-card">
              <div class="article-image">
                <!-- Placeholder image si l'image n'existe pas -->
                <img src="/public/uploads/<?= $article['imageName'] ?>" onerror="this.src='https://placehold.co/600x400?text=Java+vs+Python'" alt="<?= $article['imageAlt'] ?>">
                
                <!-- Overlay avec bouton Voir -->
                <div class="article-overlay">
                  <a href="/article.php?id=<?= $article['id'] ?>" class="btn-view-article">
                    <i class="mdi mdi-eye"></i> <?= $trad["projectSection"]["viewButton"] ?? "Voir" ?>
                  </a>
                </div>
              </div>
              <div class="article-content">
                <h3><a href="/article.php?id=<?= $article['id'] ?>"><?= $article['title'] ?></a></h3>
                <p class="article-date"><small><?= date('d/m/Y', strtotime($article['created_at'])) ?></small></p>
                <p class="article-excerpt"><?= substr(strip_tags($article['content']), 0, 150) ?>...</p>
                <a href="/article.php?id=<?= $article['id'] ?>" class="btn-read-more"><?= $trad["articles"]["read_more"] ?? "Lire la suite" ?></a>
              </div>
            </article>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>
  <script src="./assets/js/shared-js.js?parent=articles.php"></script>
  <script src="./assets/js/main.js"></script>
</body>

</html>
