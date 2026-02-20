<?php
// Handle data and then add it to the database.
if (!empty($_GET['id'])) {
  require_once __DIR__ . "/../../../assets/models/Articles.php";

  $id = $_GET['id'];
  $article = new Articles();

  $success = $article->deleteArticle($id);
  if ($success) {
    header("Location: /admin/articles.php");
    exit;
  }
}
