<?php

require_once 'Database.php';

class Projects extends Database
{
  public function __construct()
  {
    parent::__construct();
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

    return $statement->fetch();
  }

  public function getProjects()
  {
    return $this->pdo->query('SELECT * FROM projects')->fetchAll();
  }
}
