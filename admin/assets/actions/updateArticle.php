<?php
// Handle data and then add it to the database.
if (!empty($_POST)) {
  require_once __DIR__ . "/../../../assets/models/Articles.php";

  $id = $_GET['id'];
  $article = new Articles();
  $articleTitle = $_POST["article-title"];
  $articleContent = $_POST["content"];
  $textAltImg = $_POST["text-alt"];
  $imageFile = $_FILES["file-upload-field"];

  $success = $article->updateArticle($id, $articleTitle, $articleContent, $textAltImg, $imageFile);
  if ($success) {
    header("Location: /admin/articles.php");
    exit;
  }
}
