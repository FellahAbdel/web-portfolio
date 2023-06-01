<?php

abstract class Database
{
  protected PDO $pdo;
  private const HOST = 'mysql-fellah.alwaysdata.net';
  private const DBNAME = 'fellah_database';
  private const USER = 'fellah_phpmyadmi';
  private const PASS = 'famillediallo';

  public function __construct()
  {
    $this->pdo = new PDO('mysql:host=' . Database::HOST . ';dbname=' . Database::DBNAME, Database::USER, Database::PASS);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
