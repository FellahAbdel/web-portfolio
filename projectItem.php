<?php
require_once './assets/locales/en.php';
include __DIR__ . '/./assets/models/Projects.php';

$projectId = $_GET["id"];
$projects = new Projects();
$project = $projects->getProject(intval($projectId));

?>
<!DOCTYPE html>
<html lang="en">

<?php
require_once './assets/templates/head.php'
?>

<body>
  <header>
    <!--I added this.-->
    <a href="/index.html">Fellah</a>
    <?php
    include './assets/locales/en.php';
    include './assets/templates/nav.php'
    ?>
  </header>
  <main>

  </main>
  <?php
  require_once './assets/templates/footer.php'
  ?>
</body>

</html>