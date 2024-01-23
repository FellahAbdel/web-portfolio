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
  require_once __DIR__ . '/../assets/locales/en.php';
} else {
  require_once __DIR__ . '/../assets/locales/fr.php';
}

$button = "update button";
$fileHandler = "update.php";

include __DIR__ . '/../assets/models/Projects.php';

if (!empty($_GET["id"])) {
  $projectId = checkInput($_GET["id"]);
  $fileHandler .= "?id=" . $projectId;
  $projects = new Projects();
  $project = $projects->getProject(intval($projectId));
  $title = $project["title"];
  $description = $project["description"];
  $textAlt = $project["imageAlt"];
  $imageName = $project["imageName"];
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
  <?php
  require_once __DIR__ . '/../assets/templates/head.php'
  ?>
  <link rel="stylesheet" href="/admin/assets/css/bootstrapp.css" />
  <link rel="stylesheet" href="/assets/css/shared.css" />
  <link rel="stylesheet" href="/assets/css/form-item.css" />
  <link rel="stylesheet" href="/admin/assets/css/project-form.css" />
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
  <title>Update current project</title>
</head>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.php">Fellah</a>
    <?php
    require_once __DIR__ . '/../assets/templates/nav.php'
    ?>
  </header>
  <main>
    <h1>
      <?= $trad["adminPageTitle"]["update"] ?>
    </h1>
    <?php include __DIR__ . '/assets/templates/projectForm.php' ?>
  </main>
  <?php
  require_once __DIR__ . '/../assets/templates/footer.php'
  ?>
  <script src="/assets/js/shared-js.js?parent=admin/update.php"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/admin/assets/js/formProject.js?fileName=update" type="module"></script>
</body>

</html>