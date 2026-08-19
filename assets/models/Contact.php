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
      is_read TINYINT(1) DEFAULT 0,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    try {
      $this->pdo->query("ALTER TABLE potentialClient ADD COLUMN is_read TINYINT(1) DEFAULT 0");
    } catch (Exception $e) {
      // Colonne déjà existante
    }

    try {
      $this->pdo->query("ALTER TABLE potentialClient ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    } catch (Exception $e) {
      // Colonne déjà existante
    }
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
      $stmt = $this->pdo->prepare("INSERT INTO potentialClient (`clientName`, `clientEmail`, `clientPhoneNumber`, `clientMessage`, `is_read`) 
                               VALUES (:name, :email, :phoneNumber, :msg, 0)");

      $stmt->bindValue(":name", htmlspecialchars(trim($clientInputs[0])));
      $stmt->bindValue(":email", htmlspecialchars(trim($clientInputs[1])));
      $stmt->bindValue(":phoneNumber", htmlspecialchars(trim($clientInputs[2])));
      $stmt->bindValue(":msg", htmlspecialchars(trim($clientInputs[3])));

      return $stmt->execute();
    }
    return false;
  }

  public function getAllMessages(?string $filter = 'all', ?string $search = null): array
  {
    $sql = "SELECT * FROM potentialClient WHERE 1=1";
    $params = [];

    if ($filter === 'unread') {
      $sql .= " AND (is_read = 0 OR is_read IS NULL)";
    } elseif ($filter === 'read') {
      $sql .= " AND is_read = 1";
    }

    if (!empty($search)) {
      $sql .= " AND (clientName LIKE :search OR clientEmail LIKE :search OR clientPhoneNumber LIKE :search OR clientMessage LIKE :search)";
      $params[':search'] = '%' . trim($search) . '%';
    }

    $sql .= " ORDER BY created_at DESC, id DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getMessage(int $id): ?array
  {
    $stmt = $this->pdo->prepare("SELECT * FROM potentialClient WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
  }

  public function markAsRead(int $id): bool
  {
    $stmt = $this->pdo->prepare("UPDATE potentialClient SET is_read = 1 WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function markAsUnread(int $id): bool
  {
    $stmt = $this->pdo->prepare("UPDATE potentialClient SET is_read = 0 WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function toggleReadStatus(int $id): bool
  {
    $stmt = $this->pdo->prepare("UPDATE potentialClient SET is_read = CASE WHEN is_read = 1 THEN 0 ELSE 1 END WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function deleteMessage(int $id): bool
  {
    $stmt = $this->pdo->prepare("DELETE FROM potentialClient WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function getStats(): array
  {
    $totalStmt = $this->pdo->query("SELECT COUNT(*) FROM potentialClient");
    $total = (int) $totalStmt->fetchColumn();

    $unreadStmt = $this->pdo->query("SELECT COUNT(*) FROM potentialClient WHERE is_read = 0 OR is_read IS NULL");
    $unread = (int) $unreadStmt->fetchColumn();

    $read = $total - $unread;

    return [
      'total' => $total,
      'unread' => $unread,
      'read' => max(0, $read)
    ];
  }

  public function getUnreadCount(): int
  {
    $stmt = $this->pdo->query("SELECT COUNT(*) FROM potentialClient WHERE is_read = 0 OR is_read IS NULL");
    return (int) $stmt->fetchColumn();
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
