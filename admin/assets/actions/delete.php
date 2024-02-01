<?php
if (!empty($_POST)) {
  require_once __DIR__ . "/../../../assets/models/Projects.php";
  $projectId = $_POST["project-id"];
  $projectId = intval($projectId);
  $project = new Projects();
  $success = $project->deleteProject($projectId);
  if ($success) {
    header("Location: /admin/index.php");
  }
}
