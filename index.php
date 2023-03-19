<?php
require_once './assets/locales/en.php';
include __DIR__ . '/./assets/models/Projects.php';

$projects = new Projects();

// Get parameters
$start = 0;
$count = 3;

// Check if the user is on a mobile device
if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile/i', $_SERVER['HTTP_USER_AGENT'])) {
  $count = 1; // Load 1 project initially on mobile devices
}

$allProject = $projects->getProjectBetween($start, $count);
// header("Content-Type: application/json");
// echo json_encode($projects);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&family=Oleo+Script:wght@700&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/shared.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <title>fellah's portfolio</title>
</head>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.html">Fellah</a>
    <?php
    require_once './assets/templates/nav.php'
    ?>
  </header>
  <main>
    <section>
      <div id="home">
        <div>
          <ul>
            <li>
              <a href=""><i class="mdi mdi-github"></i></a>
            </li>
            <li>
              <a href=""><i class="mdi mdi-twitter"></i></a>
            </li>
            <li>
              <a href=""><i class="mdi mdi-linkedin"></i></a>
            </li>
            <li></li>
          </ul>
          <svg viewBox="0 0 200 187" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <mask id="mask0" mask-type="alpha">
              <path d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 165.547 
        130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 129.362C2.45775 
        97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 -0.149132 97.9666 
        0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z" />
            </mask>
            <g mask="url(#mask0)">
              <path d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 
        165.547 130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 
        129.362C2.45775 97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 
        -0.149132 97.9666 0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z" />
              <image x="12" y="-13" xlink:href="./assets/images/DSC_0590.png" />
            </g>
          </svg>
        </div>
        <?php
        require_once './assets/templates/homeData.php'
        ?>
      </div>
    </section>
    <section id="projects">
      <h2>Projects</h2>
      <ul>
        <?php foreach ($allProject as $project) : ?>
          <?php include __DIR__ . '/assets/templates/article.php' ?>
        <?php endforeach; ?>
      </ul>
    </section>
  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>
  <script src="./assets/js/ajax.js"></script>
  <script src="./assets/js/main.js"></script>
</body>

</html>