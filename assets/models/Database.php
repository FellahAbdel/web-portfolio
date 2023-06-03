<?php

abstract class Database
{
  protected PDO $pdo;
  private static $host;
  private static $dbname;
  private static $user;
  private static $password;

  public static function setCredentials()
  {
    self::$host = $_ENV['DB_HOST'];
    self::$dbname = $_ENV['DB_NAME'];
    self::$user = $_ENV['DB_USER'];
    self::$password = $_ENV['DB_PASSWORD'];
  }

  public function __construct()
  {
    Database::setCredentials();

    // Use the credentials to connect to the database
    $pdo = new PDO(
      'mysql:host=' . Database::$host . ';dbname=' . Database::$dbname,
      Database::$user,
      Database::$password
    );

    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
