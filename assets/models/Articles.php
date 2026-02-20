<?php

require_once 'Database.php';

class Articles extends Database
{
  public function __construct()
  {
    parent::__construct();
    $this->initTable();
  }

  private function initTable()
  {
    $this->pdo->query("CREATE TABLE IF NOT EXISTS articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    imageName VARCHAR(255) NOT NULL,
    imageAlt VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
  }

  public function getArticle(int $id)
  {
    $statement = $this->pdo->prepare('SELECT * FROM articles WHERE id=:identifiant');
    $statement->bindValue(':identifiant', $id);
    $statement->execute();

    return $statement->fetch();
  }

  public function getArticles()
  {
    return $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC')->fetchAll();
  }

  /**
   * @param $field
   * @param $isRequired
   * @param $minLength
   * @param $maxLength
   * @param $regex
   *
   * @return bool
   */
  private function checkField($field, $isRequired, $minLength = null, $maxLength = null, $regex = null)
  {
    if ($isRequired && empty($field)) {
      return false;
    }
    if ($minLength && strlen($field) < $minLength) {
      return false;
    }

    if ($maxLength && strlen($field) > $maxLength) {
      return false;
    }

    if ($regex && !preg_match($regex, $field)) {
      return false;
    }

    return true;
  }

  public function savePicture($picture)
  {
    $extension = pathinfo($picture['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $result = move_uploaded_file($picture['tmp_name'], __DIR__ . '/../../public/uploads/' . $filename);

    if (!$result) {
      return false;
    }

    return $filename;
  }

  public function insertArticle($title, $content, $imageTextAlt, $picture)
  {
    if (
      $this->checkField($title, true, 2, 255) &&
      $this->checkField($content, true, 10) &&
      $this->checkField($imageTextAlt, true, 1, 255)
    ) {
      try {
        $pictureName = $this->savePicture($picture);

        if (!$pictureName) {
          return false;
        }

        $statement = $this->pdo->prepare(
          'INSERT INTO articles (title, content, imageAlt, imageName) 
          VALUES (:title, :content, :imageTextAlt, :image )'
        );
        $statement->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
        $statement->bindValue(':content', htmlspecialchars($content), PDO::PARAM_STR);
        $statement->bindValue(':imageTextAlt', htmlspecialchars($imageTextAlt), PDO::PARAM_STR);
        $statement->bindValue(':image', $pictureName, PDO::PARAM_STR);
        return $statement->execute();
      } catch (Exception $e) {
        return false;
      }
    }
    return false;
  }


  public function updateArticle($id, $title, $content, $imageTextAlt, $newPicture)
  {
    $article = $this->getArticle($id);

    if (!$article) {
      return false;
    }

    $oldImageName = $article['imageName'];

    if (
      $this->checkField($title, true, 2, 255) &&
      $this->checkField($content, true, 10) &&
      $this->checkField($imageTextAlt, true, 1, 255)
    ) {
      try {
        if ($newPicture['name']) {
          $newImageName = $this->savePicture($newPicture);
          if (!$newImageName) {
            return false;
          }

          // Remove the old image
          $this->removeImage($oldImageName);
        } else {
          $newImageName = $oldImageName;
        }

        $statement = $this->pdo->prepare(
          'UPDATE articles SET title=:title, content=:content, imageAlt=:imageTextAlt, imageName=:image WHERE id=:id'
        );
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
        $statement->bindValue(':content', htmlspecialchars($content), PDO::PARAM_STR);
        $statement->bindValue(':imageTextAlt', htmlspecialchars($imageTextAlt), PDO::PARAM_STR);
        $statement->bindValue(':image', $newImageName, PDO::PARAM_STR);
        return $statement->execute();
      } catch (Exception $e) {
        return false;
      }
    }

    return false;
  }

  private function removeImage($imageName)
  {
    $filePath = __DIR__ . '/../../public/uploads/' . $imageName;

    if (file_exists($filePath)) {
      unlink($filePath);
    }
  }

  public function deleteArticle($id)
  {
    $article = $this->getArticle($id);

    if (!$article) {
      return false;
    }

    $articleImageName = $article['imageName'];

    if (
      $this->checkField($id, true)
    ) {
      try {
        $this->removeImage($articleImageName);

        $statement = $this->pdo->prepare(
          'DELETE FROM articles WHERE id=:articleId'
        );
        $statement->bindValue(':articleId', $id, PDO::PARAM_INT);
        return $statement->execute();
      } catch (Exception $e) {
        return false;
      }
    }

    return false;
  }
}
