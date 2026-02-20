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
    // Chemin vers le fichier .env (à la racine du projet)
    // __DIR__ = assets/models
    // ../ = assets
    // ../../ = racine du projet
    $envPath = __DIR__ . '/../../.env';

    if (file_exists($envPath)) {
      // ENVIRONNEMENT LOCAL : On charge le fichier .env
      $env = parse_ini_file($envPath);
      self::$host = $env['DB_HOST'] ;
      self::$dbname = $env['DB_NAME'] ;
      self::$user = $env['DB_USER'] ;
      self::$password = $env['DB_PASSWORD'] ;
    } else {
      // PRODUCTION : Le fichier .env n'existe pas (car ignoré par git),
      // on utilise donc les variables d'environnement du serveur ($_ENV ou getenv)
      self::$host = $_ENV['DB_HOST'] ;
      self::$dbname = $_ENV['DB_NAME'];
      self::$user = $_ENV['DB_USER'] ;
      self::$password = $_ENV['DB_PASSWORD'] ;
    }
  }

  public function __construct()
  {
    Database::setCredentials();

    // Vérification de la présence du pilote MySQL
    if (!in_array('mysql', PDO::getAvailableDrivers())) {
      die("Erreur critique : Le pilote MySQL (pdo_mysql) n'est pas activé dans votre configuration PHP. <br>Veuillez ouvrir votre fichier <strong>php.ini</strong> et décommenter la ligne <code>extension=pdo_mysql</code> (enlevez le point-virgule au début).<br>Ensuite, redémarrez votre serveur PHP.");
    }

    // Connexion à MySQL
    $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=utf8mb4';

    try {
      $this->pdo = new PDO(
        $dsn,
        self::$user,
        self::$password
      );
    } catch (PDOException $e) {
      die("Erreur de connexion à la base de données : " . $e->getMessage() . "<br>Hôte tenté : " . self::$host . "<br>Utilisateur : " . self::$user);
    }

    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
