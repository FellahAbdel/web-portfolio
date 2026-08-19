<?php

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode([
    'success' => false,
    'error' => 'Méthode non autorisée.'
  ]);
  exit;
}

$name = trim($_POST['user-name'] ?? '');
$email = trim($_POST['user-email'] ?? '');
$phone = trim($_POST['user-number'] ?? '');
$message = trim($_POST['user-msg'] ?? '');

if (empty($name) || empty($email) || empty($phone) || empty($message)) {
  http_response_code(400);
  echo json_encode([
    'success' => false,
    'error' => 'Tous les champs sont obligatoires.'
  ]);
  exit;
}

try {
  require_once __DIR__ . "/../models/Contact.php";
  $client = new Contact();

  $userInputs = [$name, $email, $phone, $message];

  if (!$client->checkClientInputs($userInputs)) {
    http_response_code(400);
    echo json_encode([
      'success' => false,
      'error' => 'Données invalides. Veuillez vérifier les informations saisies.'
    ]);
    exit;
  }

  $stored = $client->storeClientInputs($userInputs);

  if ($stored) {
    // Tentative d'envoi d'email de notification (ne bloque pas si échec smtp)
    @$client->sendNotificationEmail($name, $email, $phone, $message);

    http_response_code(200);
    echo json_encode([
      'success' => true,
      'message' => 'Votre message a été envoyé avec succès !'
    ]);
  } else {
    http_response_code(500);
    echo json_encode([
      'success' => false,
      'error' => 'Erreur lors de l\'enregistrement de votre message. Veuillez réessayer.'
    ]);
  }
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode([
    'success' => false,
    'error' => 'Une erreur interne est survenue. Veuillez réessayer plus tard.'
  ]);
}
