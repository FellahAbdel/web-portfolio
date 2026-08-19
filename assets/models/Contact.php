<?php

require_once 'Database.php';

class Contact extends Database
{
  public function __construct()
  {
    parent::__construct();
    $this->initTable();
  }

  private function initTable()
  {
    $this->pdo->query("CREATE TABLE IF NOT EXISTS potentialClient(
      id INT PRIMARY KEY AUTO_INCREMENT,
      clientName VARCHAR(255) NOT NULL,
      clientEmail VARCHAR(255) NOT NULL,
      clientPhoneNumber VARCHAR(255) NOT NULL,
      clientMessage TEXT NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
  }

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

  public function checkClientInputs($clientInputs): bool
  {
    $clientNameValid = $this->checkField($clientInputs[0], true, 2, 255);
    $clientEmailValid = $this->checkField($clientInputs[1], true, 1, 255) && filter_var($clientInputs[1], FILTER_VALIDATE_EMAIL);
    $clientPhoneNumberV = $this->checkField($clientInputs[2], true, 1, 50, '/^[0-9+ \.\-\(\)]{7,30}$/');
    $clientMessageV = $this->checkField($clientInputs[3], true, 1, 5000);
    return $clientEmailValid && $clientNameValid && $clientMessageV && $clientPhoneNumberV;
  }

  public function storeClientInputs($clientInputs): bool
  {
    if ($this->checkClientInputs($clientInputs)) {
      $stmt = $this->pdo->prepare("INSERT INTO potentialClient (`clientName`, `clientEmail`, `clientPhoneNumber`, `clientMessage`) 
                               VALUES (:name, :email, :phoneNumber, :msg)");

      $stmt->bindValue(":name", htmlspecialchars(trim($clientInputs[0])));
      $stmt->bindValue(":email", htmlspecialchars(trim($clientInputs[1])));
      $stmt->bindValue(":phoneNumber", htmlspecialchars(trim($clientInputs[2])));
      $stmt->bindValue(":msg", htmlspecialchars(trim($clientInputs[3])));

      return $stmt->execute();
    }
    return false;
  }

  public function sendNotificationEmail(string $name, string $email, string $phone, string $message): bool
  {
    $to = "abdoulazizdiallofouta@gmail.com";
    $subject = "=?UTF-8?B?" . base64_encode("Nouveau message de contact - Portfolio (Projet Web)") . "?=";

    $body = "Bonjour Aziz,\n\n";
    $body .= "Vous avez reçu un nouveau message depuis la page Contact de votre portfolio :\n\n";
    $body .= "----------------------------------------\n";
    $body .= "Nom : " . $name . "\n";
    $body .= "Email : " . $email . "\n";
    $body .= "Téléphone : " . $phone . "\n";
    $body .= "----------------------------------------\n\n";
    $body .= "Description du projet / Message :\n";
    $body .= $message . "\n\n";
    $body .= "----------------------------------------\n";
    $body .= "Date : " . date('d/m/Y H:i:s') . "\n";

    $headers = [
      "From: Portfolio Contact <contact@fellah.alwaysdata.net>",
      "Reply-To: " . $email,
      "X-Mailer: PHP/" . phpversion(),
      "Content-Type: text/plain; charset=UTF-8"
    ];

    return @mail($to, $subject, $body, implode("\r\n", $headers));
  }
}
