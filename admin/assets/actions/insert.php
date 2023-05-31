<?php
// Handle data and then add it to the database.
if (!empty($_POST)) {
  require_once __DIR__ . "/../../../assets/models/Projects.php";

  $project = new Projects();
  $projectName = $_POST["project-title"];
  $projectDescription = $_POST["description"];
  $textAltImg = $_POST["text-alt"];
  $imageFile = $_FILES["file-upload-field"];

  $success = $project->insertProject($projectName, $projectDescription, $textAltImg, $imageFile);
  if ($success) {
    header("Location: /admin/index.php");
    exit;
  }
}
