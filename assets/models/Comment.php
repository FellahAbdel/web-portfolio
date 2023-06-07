<?php

require_once 'Database.php';

class Comment extends Database
{
  public function __construct()
  {
    parent::__construct();
    $this->initTable();
  }

  private function initTable()
  {
    $this->pdo->query("CREATE TABLE IF NOT EXISTS comments (
      id INTEGER PRIMARY KEY AUTO_INCREMENT,
      pseudo VARCHAR(255) NOT NULL,
      comment TEXT NOT NULL,
      projectId INTEGER,
      FOREIGN KEY (projectId) REFERENCES projects(id)
    )");
  }

  private function checkClientInputs($clientInputs): bool
  {
    $pseudoNameValid = $clientInputs[0] !== "" && strlen($clientInputs[0]) <= 255;
    $commentValid = $clientInputs[1] !== "" && strlen($clientInputs[1]) <= 555;
    return $pseudoNameValid && $commentValid;
  }

  public function storeClientInputs($clientInputs)
  {
    if ($this->checkClientInputs($clientInputs)) {
      $stmt = $this->pdo->prepare("INSERT INTO comments (`pseudo`, `comment`, `projectId`) 
                               VALUES (:name, :msg, :id)");

      $stmt->bindValue(":name", htmlspecialchars($clientInputs[0]));
      $stmt->bindValue(":msg", htmlspecialchars($clientInputs[1]));
      $stmt->bindValue(":id", htmlspecialchars($clientInputs[2]));

      $stmt->execute();
    }
  }
  public function commentFor($projectId)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE projectId=:identifiant");
    $stmt->bindValue(":identifiant", $projectId);
    $stmt->execute();

    return $stmt->fetchAll();
  }
}
