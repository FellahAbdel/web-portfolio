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

  public function getProjects()
  {
    return $this->pdo->query('SELECT * FROM projects')->fetchAll();
  }
}
