<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../../assets/models/Contact.php';

try {
  $contact = new Contact();
  $method = $_SERVER['REQUEST_METHOD'];

  if ($method === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    switch ($action) {
      case 'mark_read':
        if ($id <= 0) throw new Exception('ID invalide.');
        $success = $contact->markAsRead($id);
        $stats = $contact->getStats();
        echo json_encode(['success' => $success, 'stats' => $stats, 'is_read' => 1]);
        break;

      case 'mark_unread':
        if ($id <= 0) throw new Exception('ID invalide.');
        $success = $contact->markAsUnread($id);
        $stats = $contact->getStats();
        echo json_encode(['success' => $success, 'stats' => $stats, 'is_read' => 0]);
        break;

      case 'toggle_read':
        if ($id <= 0) throw new Exception('ID invalide.');
        $success = $contact->toggleReadStatus($id);
        $msg = $contact->getMessage($id);
        $stats = $contact->getStats();
        echo json_encode([
          'success' => $success,
          'stats' => $stats,
          'is_read' => $msg ? (int)$msg['is_read'] : 0
        ]);
        break;

      case 'delete':
        if ($id <= 0) throw new Exception('ID invalide.');
        $success = $contact->deleteMessage($id);
        $stats = $contact->getStats();
        echo json_encode(['success' => $success, 'stats' => $stats]);
        break;

      default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Action inconnue.']);
        break;
    }
    exit;
  } elseif ($method === 'GET') {
    $action = $_GET['action'] ?? '';

    if ($action === 'get_detail') {
      $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
      if ($id <= 0) throw new Exception('ID invalide.');

      $msg = $contact->getMessage($id);
      if (!$msg) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Message introuvable.']);
        exit;
      }

      // Si le paramètre mark_as_read est présent, on le marque comme lu
      if (isset($_GET['mark_as_read']) && $_GET['mark_as_read'] === '1' && (empty($msg['is_read']) || $msg['is_read'] == 0)) {
        $contact->markAsRead($id);
        $msg['is_read'] = 1;
      }

      $stats = $contact->getStats();
      echo json_encode(['success' => true, 'message' => $msg, 'stats' => $stats]);
      exit;
    } elseif ($action === 'get_stats') {
      $stats = $contact->getStats();
      echo json_encode(['success' => true, 'stats' => $stats]);
      exit;
    }
  }

  http_response_code(405);
  echo json_encode(['success' => false, 'error' => 'Méthode non autorisée.']);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
