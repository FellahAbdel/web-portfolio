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
  <!-- <link rel="stylesheet" href="/admin/assets/css/bootstrapp.css" /> -->
  <script src="https://cdn.tiny.cloud/1/9vn6cnyc2nhzsn1onc2crevikcwxivlfrir4y43qht5odb8x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
  <script>
    tinymce.init({
      selector: "textarea",
      plugins: "ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss",
      toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
      tinycomments_mode: "embedded",
      tinycomments_author: "Author name",
      mergetags_list: [{
          value: "First.Name",
          title: "First Name"
        },
        {
          value: "Email",
          title: "Email"
        },
      ],
      ai_request: (request, respondWith) =>
        respondWith.string(() =>
          Promise.reject("See docs to implement AI Assistant")
        ),
    });
  </script>
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
      <img src="/public/uploads/<?= $project["imageName"] ?>" alt="<?= $project["imageAlt"] ?>">
      <h1><?= $project["title"] ?></h1>
      <textarea><?= $project["description"] ?></textarea>
    </article>
    <hr>
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
      <div class="form-group">
        <a href="/index.php" class="btn btn-dark btn-lg"><span class="mdi mdi-arrow-left"></span> <?= $trad["AdminProjectForm"]["go-back-btn"] ?></a>
      </div>
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