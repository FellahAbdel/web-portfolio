<?php
$en_select = "";
$fr_select = "";
if (isset($_GET['lang']) && $_GET['lang'] == 'en' || !isset($_GET['lang'])) {
  require_once __DIR__ . '/../assets/locales/en.php';
  $en_select = "selected";
} else {
  require_once __DIR__ . '/../assets/locales/fr.php';
  $fr_select = "selected";
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
  <link rel="stylesheet" href="/assets/css/shared.css" />
  <link rel="stylesheet" href="/assets/css/form-item.css" />
  <link rel="stylesheet" href="/admin/assets/css/project-form.css" />
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