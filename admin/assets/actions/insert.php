<?php
// Handle data and then add it to the database.
if (!empty($_POST)) {
  require_once __DIR__ . "/../../../models/Insert.php";

  $insert = new Insert();
  $projectName = $_POST["project-title"];
  $projectDescription = $_POST["description"];

  $userInputs = array($_POST["user-name"], $_POST["user-email"], $_POST["user-number"], $_POST["user-msg"]);

  // var_dump($userInputs);
  $client->storeClientInputs($userInputs);
}
