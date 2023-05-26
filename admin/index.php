<?php
$en_select = "";
$fr_select = "";
if (isset($_GET['lang']) && $_GET['lang'] == 'en' || !isset($_GET['lang'])) {
  require_once '../assets/locales/en.php';
  $en_select = "selected";
} else {
  require_once '../assets/locales/fr.php';
  $fr_select = "selected";
}

include __DIR__ . '/../assets/models/Projects.php';
// var_dump(__DIR__ . '/../assets/models/Projects.php');
$projects = new Projects();

$allProject = $projects->getProjects();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once '../assets/templates/head.php'
  ?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/shared.css" />
  <link rel="stylesheet" href="./assets/css/styles.css" />
  <title>fellah's portfolio</title>
</head>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.php">Fellah</a>
    <?php
    require_once '../assets/templates/nav.php'
    ?>
  </header>
  <main>
    <section class="container admin">
      <div class="row">
        <h1><strong> Projects list </strong>
          <a href="insert.php" class="btn btn-success btn-lg">
            <span class="glyphicon glyphicon-plus">Ajouter</span>
          </a>
        </h1>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allProject as $project) : ?>
              <?php include __DIR__ . '/assets/templates/tableRow.php' ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <?php
  require_once '../assets/templates/footer.php'
  ?>
  <script src="/assets/js/shared-js.js?parent=index.php"></script>
  <script src="/assets/js/ajax.js"></script>
  <script src="/assets/js/main.js"></script>
</body>

</html>