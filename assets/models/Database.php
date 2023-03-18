<?php

abstract class Database
{
  protected PDO $pdo;

  public function __construct()
  {
    $this->pdo = new PDO('sqlite:' . dirname(__FILE__) . '/database.db');
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
