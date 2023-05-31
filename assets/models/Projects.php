<?php

require_once 'Database.php';

class Projects extends Database
{
  public function __construct()
  {
    parent::__construct();
    $this->initTable();
  }

  private function initTable()
  {
    $this->pdo->query("CREATE TABLE IF NOT EXISTS projects (
      id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL UNIQUE,
	    title	varchar(255) NOT NULL,
	    description	TEXT NOT NULL,
	    imageName	varchar(255) NOT NULL,
	    imageAlt	varchar(255) NOT NULL
    )");
  }

  public function getProject(int $id)
  {
    $statement = $this->pdo->prepare('SELECT * FROM projects WHERE id=:identifiant');
    $statement->bindValue(':identifiant', $id);
    $statement->execute();

    return $statement->fetch();
  }

  public function getProjectBetween(int $startPosition, int $countProject)
  {
    $statement = $this->pdo->prepare(
      'SELECT * FROM projects
      ORDER BY id
      LIMIT :start, :countP'
    );
    $statement->bindValue(':start', $startPosition, PDO::PARAM_INT);
    $statement->bindValue(':countP', $countProject, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll();
  }

  public function getProjects()
  {
    return $this->pdo->query('SELECT * FROM projects')->fetchAll();
  }


  // Inserting project.

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

  public function insertProject($title, $description, $imageTextAlt, $picture)
  {
    if (
      $this->checkField($title, true, 2, 255) &&
      $this->checkField($description, true, 100, 2000) &&
      $this->checkField($imageTextAlt, true, 1, 255)
    ) {
      try {
        print_r("start");
        $pictureName = $this->savePicture($picture);

        print_r("it not working");
        if (!$pictureName) {
          return false;
        }
        print_r("It works");
        $statement = $this->pdo->prepare(
          'INSERT INTO projects (title, description, imageAlt, imageName) 
          VALUES (:title, :description, :imageTextAlt, :image )'
        );
        $statement->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
        $statement->bindValue(':description', htmlspecialchars($description), PDO::PARAM_STR);
        $statement->bindValue(':imageTextAlt', htmlspecialchars($imageTextAlt), PDO::PARAM_STR);
        $statement->bindValue(':image', $pictureName, PDO::PARAM_STR);
        return $statement->execute();
      } catch (Exception $e) {
        var_dump($e);
        return false;
      }
    }
    print_r("false");
    return false;
  }


  public function updateProject($id, $title, $description, $imageTextAlt, $newPicture)
  {
    $project = $this->getProject($id);

    if (!$project) {
      return false;
    }
    $oldImageName = $project['imageName'];

    if (
      $this->checkField($title, true, 2, 255) &&
      $this->checkField($description, false) &&
      $this->checkField($imageTextAlt, true, 1, 255)
    ) {
      try {
        print_r("here");
        if ($newPicture['name']) {
          $newImageName = $this->savePicture($newPicture);
          var_dump($newImageName);
          if (!$newImageName) {
            return false;
          }

          print_r("here 2");
          // Remove the old image
          $this->removeImage($oldImageName);
        } else {
          $newImageName = $oldImageName;
        }

        $statement = $this->pdo->prepare(
          'UPDATE projects SET title=:title, description=:description, imageAlt=:imageTextAlt, imageName=:image WHERE id=:id'
        );
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
        $statement->bindValue(':description', htmlspecialchars($description), PDO::PARAM_STR);
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

  public function deleteProject($id)
  {
    $project = $this->getProject($id);

    if (!$project) {
      return false;
    }

    $projectImageName = $project['imageName'];

    if (
      $this->checkField($id, true)
    ) {
      try {
        $this->removeImage($projectImageName);

        $statement = $this->pdo->prepare(
          'DELETE FROM projects WHERE id=:projectId'
        );
        $statement->bindValue(':projectId', $id, PDO::PARAM_INT);
        return $statement->execute();
      } catch (Exception $e) {
        return false;
      }
    }

    return false;
  }
}
