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

if (!isset($_GET['id'])) {
  header("Location: /articles.php");
  exit;
}

$id = $_GET['id'];

// Article statique
$article = null;
if ($id == 1) {
  $article = [
    'id' => 1,
    'title' => "Du Java au Python : Quand Spring Boot rencontre FastAPI",
    'created_at' => "2026-02-19 14:00:00",
    'imageName' => "python-java.jpeg",
    'imageAlt' => "Java vs Python",
    'content' => '
      <p>Le 19 février 2026, j\'ai assisté à une présentation technique captivante animée par Paul, ingénieur logiciel et ancien "Javaïste" convaincu. Son défi ? Démontrer comment l\'écosystème Python, souvent perçu comme le terrain de jeu des Data Scientists, peut répondre aux exigences d\'industrialisation des développeurs Java.</p>

      <p>Dans le monde du développement, la guerre des langages est un vieux refrain. Pourtant, Paul a ouvert sa conférence par un "Disclaimer" essentiel : il ne s\'agit pas de savoir quel langage est le meilleur, mais de comprendre comment leurs philosophies divergent et comment elles peuvent se rejoindre autour de pratiques de qualité.</p>

      <div class="table-of-contents">
        <h3>Table des matières</h3>
        <ul>
          <li><a href="#philosophies">1. Une bataille de philosophies : Rigidité vs Liberté</a></li>
          <li><a href="#standards">2. Transposer les standards Java dans l\'écosystème Python</a></li>
          <li><a href="#comparatif">3. Le comparatif en un coup d\'œil</a></li>
          <li><a href="#avis">4. Mon avis sur cette conférence</a></li>
          <li><a href="#code">5. Pour les curieux : explorez le code</a></li>
          <li><a href="#references">6. Références et outils utiles</a></li>
          <li><a href="#conclusion">7. Conclusion</a></li>
        </ul>
      </div>

      <h2 id="philosophies">Une bataille de philosophies : Rigidité vs Liberté</h2>

      <p>Venant de l\'univers Java / Spring Boot, Paul a souligné le choc culturel vécu lors de sa transition vers Python.</p>

      <p><strong>Java</strong> est le langage de l\'industrialisation par excellence. Compilé, fortement typé, il est le berceau de concepts comme le Clean Code et le DDD (Domain-Driven Design). On y cherche la sécurité avant tout.</p>

      <p><strong>Python</strong>, à l\'inverse, est interprété. Sa force réside dans sa rapidité d\'exécution (au lancement) et surtout dans sa philosophie de liberté totale : le célèbre "Duck Typing" ("Si ça ressemble à un canard et que ça cancane comme un canard, alors c’est un canard.").</p>

      <p>Cependant, cette liberté peut effrayer le développeur habitué à la rigueur du compilateur Java. C\'est là qu\'interviennent des outils modernes pour "industrialiser" Python.</p>

      <h2 id="standards">Transposer les standards Java dans l\'écosystème Python</h2>

      <p>Pour illustrer ses propos, Paul a présenté un projet de gestion de "Todo" (une application de Todo list) construit avec <strong>FastAPI</strong>, le framework Python qui monte. L\'objectif ? Retrouver la robustesse de Spring Boot.</p>

      <h3>1. La gestion des dépendances : de Maven à UV</h3>

      <p>Oubliez le traditionnel <code>venv</code> ou les fichiers <code>requirements.txt</code> archaïques. Paul recommande <strong>UV</strong> (développé par Astral), un gestionnaire de paquets ultra-rapide qui apporte une structure proche de ce qu\'on connaît avec Maven ou Gradle.</p>

      <h3>2. Qualité de code : recréer un compilateur</h3>

      <p>Puisque Python n\'est pas compilé, comment éviter les erreurs de type au runtime ? La solution réside dans un triptyque d\'outils :</p>

      <ul>
        <li><strong>MyPy (en mode strict)</strong> : Pour forcer le typage et vérifier la cohérence avant l\'exécution.</li>
        <li><strong>Ruff</strong> : Un linter et formateur de code extrêmement véloce.</li>
        <li><strong>Pre-commit</strong> : Pour garantir que personne ne pousse du code non conforme sur Git.</li>
      </ul>

      <h3>3. Architecture et Patterns : L\'héritage Java</h3>

      <p>C\'est ici que la présentation est devenue la plus technique. Paul a montré qu\'il est tout à fait possible (et recommandé) d\'utiliser des patterns "Java-esque" en Python pour maintenir un métier pur :</p>

      <ul>
        <li><strong>Repository Pattern</strong> : Utiliser des interfaces (via les Protocols en Python) pour abstraire l\'accès à la base de données.</li>
        <li><strong>SQLAlchemy</strong> : L\'équivalent d\'Hibernate/JPA pour le mapping objet-relationnel.</li>
        <li><strong>Unit of Work</strong> : Pour gérer les transactions de manière atomique, simulant le fameux <code>@Transactional</code> de Spring.</li>
      </ul>

      <h2 id="comparatif">Le comparatif en un coup d\'œil</h2>

      <p>Voici le tableau récapitulatif partagé lors de la session pour aider les développeurs à se repérer :</p>

      <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse; margin: 20px 0;">
        <thead>
          <tr style="background-color: #f2f2f2;">
            <th>Aspect</th>
            <th>Java / Spring Boot</th>
            <th>Python / FastAPI</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Compilateur / Typage</td>
            <td>javac (natif, obligatoire)</td>
            <td>mypy strict + Ruff</td>
          </tr>
          <tr>
            <td>Dépendances & Build</td>
            <td>Maven (pom.xml)</td>
            <td>uv (pyproject.toml)</td>
          </tr>
          <tr>
            <td>Interface</td>
            <td>interface + implements</td>
            <td>Protocol (duck typing)</td>
          </tr>
          <tr>
            <td>Injection de dépendances</td>
            <td>@Autowired (automatique)</td>
            <td>Depends() (explicite)</td>
          </tr>
          <tr>
            <td>Transaction</td>
            <td>@Transactional</td>
            <td>get_session + yield (try/except)</td>
          </tr>
          <tr>
            <td>Validation DTO</td>
            <td>Bean Validation (@NotNull)</td>
            <td>Pydantic (Field)</td>
          </tr>
          <tr>
            <td>Gestion d\'erreur</td>
            <td>@ControllerAdvice</td>
            <td>@app.exception_handler</td>
          </tr>
        </tbody>
      </table>

      <h2 id="avis">Mon avis sur cette conférence</h2>

      <p>Cette présentation était particulièrement rafraîchissante. Pour quelqu\'un qui ne connaîtrait pas Python, elle permet de briser le mythe du "langage de script un peu brouillon".</p>

      <p>Ce que je retiens, c\'est que l\'outil ne doit pas dicter l\'architecture. Paul a prouvé qu\'un développeur peut importer ses bonnes pratiques (Clean Architecture, tests unitaires avec Pytest) quel que soit l\'écosystème. Cependant, il a aussi mis en garde contre l\'anti-pattern majeur : essayer de forcer Python à devenir exactement du Java. Il faut savoir embrasser la légèreté de Python là où elle fait sens.</p>

      <h2 id="code">Pour les curieux : explorez le code</h2>

      <p>Pour ceux qui souhaitent comparer les implémentations de leurs propres yeux, Paul a mis à disposition les dépôts GitHub des deux versions du projet (Java et Python). C\'est une ressource précieuse pour observer comment les concepts de Clean Architecture sont transposés d\'un langage à l\'autre.</p>

      <div style="text-align: center; margin: 2rem 0;">
        <img src="public/uploads/java-python-qr-code.jpeg" alt="Codes QR vers les dépôts GitHub" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 10px;">
      </div>

      <h2 id="references">Références et outils utiles</h2>

      <p>Pour aller plus loin et mettre en pratique les concepts abordés lors de cette présentation, voici les principales références citées :</p>

      <ul>
        <li><strong>FastAPI</strong> : Framework web moderne et rapide (haute performance) pour construire des API avec Python.</li>
        <li><strong>UV (Astral)</strong> : Un installateur et gestionnaire de paquets Python extrêmement rapide, écrit en Rust.</li>
        <li><strong>SQLAlchemy</strong> : La boîte à outils SQL et le mapping objet-relationnel (ORM) de référence pour Python.</li>
        <li><strong>Alembic</strong> : Outil de gestion des migrations de base de données pour SQLAlchemy.</li>
        <li><strong>Pydantic</strong> : Bibliothèque de validation de données et de gestion de paramètres utilisant les annotations de type Python.</li>
        <li><strong>Ruff</strong> : Linter et formateur de code Python tout-en-un, conçu pour la rapidité.</li>
      </ul>

      <h2 id="conclusion">Conclusion</h2>

      <p>En fin de compte, que l\'on code en Java ou en Python, les problématiques restent les mêmes : comment produire un code maintenable, testable et robuste ? La réponse ne se trouve pas dans le langage, mais dans la rigueur des outils de qualité et la compréhension profonde des frameworks utilisés.</p>

      <p><strong>Auteur : DIALLO Abdoul Aziz - Apprenti Etudiant - Master 2 Sciences Du Logiciel</strong></p>

      <div class="article-tags">
        <span class="tag">Python</span>
        <span class="tag">Java</span>
        <span class="tag">FastAPI</span>
        <span class="tag">SpringBoot</span>
        <span class="tag">Industrialisation</span>
        <span class="tag">CleanCode</span>
        <span class="tag">Architecture</span>
        <span class="tag">Backend</span>
        <span class="tag">DevOps</span>
      </div>

    '
  ];
}

if (!$article) {
  header("Location: /articles.php");
  exit;
}
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
  <title><?= $article['title'] ?> - fellah's portfolio</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php
    require_once './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <article class="single-article">
      <div class="article-header">
        <h1><?= $article['title'] ?></h1>
        <p class="article-meta">
          <span class="date"><i class="mdi mdi-calendar"></i> <?= date('d/m/Y', strtotime($article['created_at'])) ?></span>
        </p>
      </div>
      
      <div class="article-featured-image">
        <!-- Placeholder image si l'image n'existe pas -->
        <img src="/public/uploads/<?= $article['imageName'] ?>" onerror="this.src='https://placehold.co/800x400?text=Java+vs+Python'" alt="<?= $article['imageAlt'] ?>">
      </div>

      <div class="article-body">
        <!-- On affiche le contenu tel quel car il peut contenir du HTML (si on utilise un éditeur riche) -->
        <!-- Attention : en prod, il faut s'assurer que le contenu est safe (XSS) lors de l'insertion -->
        <?= $article['content'] ?>
      </div>

      <div class="article-footer">
        <a href="/articles.php" class="btn-back"><i class="mdi mdi-arrow-left"></i> <?= $trad["articles"]["back_to_list"] ?? "Retour aux articles" ?></a>
      </div>
    </article>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>
  <script src="./assets/js/shared-js.js?parent=article.php"></script>
  <script src="./assets/js/main.js"></script>
</body>

</html>
