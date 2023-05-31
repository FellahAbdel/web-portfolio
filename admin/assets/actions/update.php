<?php
if (!empty($_POST)) {
  require_once __DIR__ . "/../../../assets/models/Projects.php";

  $project = new Projects();
  $projectName = $_POST["project-title"];
  $projectDescription = $_POST["description"];
  $textAltImg = $_POST["text-alt"];
  $imageFile = $_FILES["file-upload-field"];

  if (isset($_GET["id"])) {
    $success = $project->updateProject($id, $projectName, $projectDescription, $textAltImg, $imageFile);
    if ($success) {
      // After completing the project update, redirect to the index page
      header("Location: /admin/index.php"); // Replace "/index.php" with the actual URL of your index page
      exit; // Make sure to exit after the redirect
    }
  }
}
