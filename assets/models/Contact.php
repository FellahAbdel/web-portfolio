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
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      clientName VARCHAR(255) NOT NULL,
      clientEmail VARCHAR(255) NOT NULL,
      clientPhoneNumber VARCHAR(255) NOT NULL,
      clientMessage TEXT NOT NULL
    )");
  }

  private function checkClientInputs($clientInputs): bool
  {
    $clientNameValid = $clientInputs[0] !== "" && strlen($clientInputs[0]) <= 255;
    $clientEmailValid = $clientInputs[1] !== "" && strlen($clientInputs[1]) <= 255;
    $clientPhoneNumberV = $clientInputs[2] !== "" && strlen($clientInputs[2]) <= 255;
    $clientMessageV = $clientInputs[3] !== "" && strlen($clientInputs[3]) <= 555;
    return $clientEmailValid && $clientNameValid && $clientMessageV && $clientPhoneNumberV;
  }

  public function storeClientInputs($clientInputs)
  {
    if ($this->checkClientInputs($clientInputs)) {
      $stmt = $this->pdo->prepare("INSERT INTO potentialClient (`clientName`, `clientEmail`, `clientPhoneNumber`, `clientMessage`) 
                               VALUES (:name, :email, :phoneNumber, :msg)");

      $stmt->bindValue(":name", htmlspecialchars($clientInputs[0]));
      $stmt->bindValue(":email", htmlspecialchars($clientInputs[1]));
      $stmt->bindValue(":phoneNumber", htmlspecialchars($clientInputs[2]));
      $stmt->bindValue(":msg", htmlspecialchars($clientInputs[3]));

      // echo htmlspecialchars($clientInputs[3]);
      $stmt->execute();
    }
  }
}
