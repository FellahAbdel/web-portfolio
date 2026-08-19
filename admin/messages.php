<?php
session_start();

if (isset($_GET['lang']) && ($_GET['lang'] == 'en' || $_GET['lang'] == 'fr')) {
  $_SESSION['lang'] = $_GET['lang'];
} elseif (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = 'fr'; // Langue par défaut en admin
}

$en_select = ($_SESSION['lang'] == 'en') ? "selected" : "";
$fr_select = ($_SESSION['lang'] == 'fr') ? "selected" : "";

if ($_SESSION['lang'] == 'en') {
  require_once __DIR__ . '/../assets/locales/en.php';
} else {
  require_once __DIR__ . '/../assets/locales/fr.php';
}

require_once __DIR__ . '/../assets/models/Contact.php';

$contactModel = new Contact();
$messages = $contactModel->getAllMessages();
$stats = $contactModel->getStats();

function formatMessageDate($dateStr, $lang = 'fr') {
  if (empty($dateStr)) return '';
  $timestamp = strtotime($dateStr);
  if (!$timestamp) return htmlspecialchars($dateStr);

  if ($lang === 'fr') {
    $months = [
      1 => 'janv.', 2 => 'févr.', 3 => 'mars', 4 => 'avr.',
      5 => 'mai', 6 => 'juin', 7 => 'juil.', 8 => 'août',
      9 => 'sept.', 10 => 'oct.', 11 => 'nov.', 12 => 'déc.'
    ];
    $day = date('j', $timestamp);
    $month = $months[(int)date('n', $timestamp)] ?? date('M', $timestamp);
    $year = date('Y', $timestamp);
    $time = date('H:i', $timestamp);
    return "$day $month $year à $time";
  } else {
    return date('M j, Y \a\t g:i A', $timestamp);
  }
}
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['lang'] ?? 'fr') ?>">

<head>
  <?php require_once '../assets/templates/head.php' ?>
  <link rel="stylesheet" href="../assets/css/shared.css" />
  <link rel="stylesheet" href="./assets/css/messages.css" />
  <title><?= ($_SESSION['lang'] == 'en') ? 'Contact Messages - Admin' : 'Messages de contact - Admin' ?> - Fellah</title>
</head>

<body>
  <header>
    <a href="/index.php">Fellah</a>
    <?php require_once '../assets/templates/nav.php' ?>
  </header>

  <main>
    <div class="admin-container">

      <!-- Navigation Admin -->
      <div class="admin-subnav">
        <a href="/admin/index.php" class="admin-tab">
          <i class="mdi mdi-view-grid-outline"></i>
          <span><?= ($_SESSION['lang'] == 'en') ? 'Projects' : 'Projets' ?></span>
        </a>
        <a href="/admin/messages.php" class="admin-tab active">
          <i class="mdi mdi-email-outline"></i>
          <span><?= ($_SESSION['lang'] == 'en') ? 'Messages' : 'Messages de contact' ?></span>
          <span class="tab-badge <?= ($stats['unread'] > 0) ? '' : 'hidden' ?>" id="nav-unread-badge"><?= $stats['unread'] ?></span>
        </a>
      </div>

      <!-- En-tête & Statistiques -->
      <div class="messages-header reveal">
        <div>
          <h1><?= ($_SESSION['lang'] == 'en') ? 'Contact Messages' : 'Messages de contact' ?></h1>
          <p><?= ($_SESSION['lang'] == 'en') ? 'View and manage inquiries received from your portfolio contact form.' : 'Consultez et gérez les demandes reçues depuis le formulaire de votre portfolio.' ?></p>
        </div>

        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon total">
              <i class="mdi mdi-inbox-multiple-outline"></i>
            </div>
            <div class="stat-info">
              <span class="stat-value" id="stat-total"><?= $stats['total'] ?></span>
              <span class="stat-label"><?= ($_SESSION['lang'] == 'en') ? 'Total' : 'Total' ?></span>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon unread">
              <i class="mdi mdi-email-alert-outline"></i>
            </div>
            <div class="stat-info">
              <span class="stat-value" id="stat-unread"><?= $stats['unread'] ?></span>
              <span class="stat-label"><?= ($_SESSION['lang'] == 'en') ? 'Unread' : 'Non lus' ?></span>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon read">
              <i class="mdi mdi-email-check-outline"></i>
            </div>
            <div class="stat-info">
              <span class="stat-value" id="stat-read"><?= $stats['read'] ?></span>
              <span class="stat-label"><?= ($_SESSION['lang'] == 'en') ? 'Read' : 'Lus' ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Barre d'outils (Recherche & Filtres) -->
      <div class="messages-controls reveal">
        <div class="search-box">
          <i class="mdi mdi-magnify search-icon"></i>
          <input type="text" id="search-input" placeholder="<?= ($_SESSION['lang'] == 'en') ? 'Search by name, email, phone, keyword...' : 'Rechercher par nom, email, téléphone, mot-clé...' ?>" autocomplete="off" />
          <button type="button" class="clear-search" id="clear-search" aria-label="Effacer la recherche">
            <i class="mdi mdi-close"></i>
          </button>
        </div>

        <div class="filter-pills">
          <button type="button" class="filter-pill active" data-filter="all">
            <span><?= ($_SESSION['lang'] == 'en') ? 'All' : 'Tous' ?></span>
            <span class="pill-count" id="count-all"><?= $stats['total'] ?></span>
          </button>
          <button type="button" class="filter-pill" data-filter="unread">
            <span><?= ($_SESSION['lang'] == 'en') ? 'Unread' : 'Non lus' ?></span>
            <span class="pill-count" id="count-unread"><?= $stats['unread'] ?></span>
          </button>
          <button type="button" class="filter-pill" data-filter="read">
            <span><?= ($_SESSION['lang'] == 'en') ? 'Read' : 'Lus' ?></span>
            <span class="pill-count" id="count-read"><?= $stats['read'] ?></span>
          </button>
        </div>
      </div>

      <!-- Liste des messages -->
      <div class="messages-list" id="messages-list">
        <?php if (!empty($messages)) : ?>
          <?php foreach ($messages as $msg) : ?>
            <?php
              $isRead = !empty($msg['is_read']) && $msg['is_read'] == 1;
              $initial = mb_strtoupper(mb_substr(trim($msg['clientName'] ?? 'U'), 0, 1, 'UTF-8'), 'UTF-8');
              $formattedDate = formatMessageDate($msg['created_at'] ?? '', $_SESSION['lang']);
            ?>
            <article class="message-card reveal <?= $isRead ? '' : 'unread' ?>"
              data-id="<?= htmlspecialchars($msg['id']) ?>"
              data-read="<?= $isRead ? '1' : '0' ?>"
              data-name="<?= htmlspecialchars($msg['clientName'] ?? '') ?>"
              data-email="<?= htmlspecialchars($msg['clientEmail'] ?? '') ?>"
              data-phone="<?= htmlspecialchars($msg['clientPhoneNumber'] ?? '') ?>"
              data-date="<?= htmlspecialchars($formattedDate) ?>"
              data-message="<?= htmlspecialchars($msg['clientMessage'] ?? '') ?>">

              <div class="sender-avatar">
                <span><?= htmlspecialchars($initial) ?></span>
              </div>

              <div class="message-main">
                <div class="message-meta-top">
                  <span class="message-sender"><?= htmlspecialchars($msg['clientName'] ?? '') ?></span>
                  <?php if ($isRead) : ?>
                    <span class="message-badge read-badge">
                      <i class="mdi mdi-check"></i> <?= ($_SESSION['lang'] == 'en') ? 'Read' : 'Lu' ?>
                    </span>
                  <?php else : ?>
                    <span class="message-badge unread-badge">
                      <i class="mdi mdi-circle-medium"></i> <?= ($_SESSION['lang'] == 'en') ? 'Unread' : 'Non lu' ?>
                    </span>
                  <?php endif; ?>
                  <span class="message-date"><?= $formattedDate ?></span>
                </div>

                <div class="message-contacts-row">
                  <a href="mailto:<?= htmlspecialchars($msg['clientEmail'] ?? '') ?>" class="message-contact-item" title="Envoyer un email">
                    <i class="mdi mdi-email-outline"></i> <?= htmlspecialchars($msg['clientEmail'] ?? '') ?>
                  </a>
                  <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $msg['clientPhoneNumber'] ?? '')) ?>" class="message-contact-item" title="Appeler">
                    <i class="mdi mdi-phone-outline"></i> <?= htmlspecialchars($msg['clientPhoneNumber'] ?? '') ?>
                  </a>
                </div>

                <p class="message-preview">
                  <?= htmlspecialchars(mb_substr($msg['clientMessage'] ?? '', 0, 160, 'UTF-8')) ?><?= (mb_strlen($msg['clientMessage'] ?? '') > 160) ? '...' : '' ?>
                </p>
              </div>

              <div class="message-actions">
                <button type="button" class="action-btn btn-view" title="<?= ($_SESSION['lang'] == 'en') ? 'View full message' : 'Consulter le message' ?>">
                  <i class="mdi mdi-eye-outline"></i>
                </button>
                <button type="button" class="action-btn btn-toggle-read" title="<?= $isRead ? (($_SESSION['lang'] == 'en') ? 'Mark as unread' : 'Marquer comme non lu') : (($_SESSION['lang'] == 'en') ? 'Mark as read' : 'Marquer comme lu') ?>">
                  <i class="mdi <?= $isRead ? 'mdi-email-mark-as-unread' : 'mdi-email-open-outline' ?>"></i>
                </button>
                <button type="button" class="action-btn btn-delete" title="<?= ($_SESSION['lang'] == 'en') ? 'Delete message' : 'Supprimer le message' ?>">
                  <i class="mdi mdi-trash-can-outline"></i>
                </button>
              </div>
            </article>
          <?php endforeach; ?>
        <?php endif; ?>

        <!-- État vide (si aucun message) -->
        <div class="empty-state" id="empty-state" style="<?= empty($messages) ? 'display: flex;' : 'display: none;' ?>">
          <i class="mdi mdi-inbox-outline"></i>
          <h3><?= ($_SESSION['lang'] == 'en') ? 'No messages found' : 'Aucun message trouvé' ?></h3>
          <p><?= ($_SESSION['lang'] == 'en') ? 'Inquiries submitted through your contact form will appear here.' : 'Les messages envoyés depuis votre formulaire de contact apparaîtront ici.' ?></p>
        </div>
      </div>

    </div>
  </main>

  <!-- Modal Vue Détaillée -->
  <div class="modal-overlay" id="message-modal" role="dialog" aria-modal="true">
    <div class="modal-dialog">
      <div class="modal-header">
        <div class="modal-header-info">
          <div>
            <h3 class="modal-sender-name" id="modal-sender">Nom du contact</h3>
            <span class="message-date" id="modal-date">Date</span>
          </div>
          <span class="message-badge read-badge" id="modal-badge">Lu</span>
        </div>
        <button type="button" class="modal-close-btn" id="modal-close-btn" aria-label="Fermer">
          <i class="mdi mdi-close"></i>
        </button>
      </div>

      <div class="modal-body">
        <div class="modal-contact-details">
          <div class="detail-row">
            <span class="detail-label">Email</span>
            <span class="detail-value"><a href="#" id="modal-email">-</a></span>
          </div>
          <div class="detail-row">
            <span class="detail-label"><?= ($_SESSION['lang'] == 'en') ? 'Phone' : 'Téléphone' ?></span>
            <span class="detail-value"><a href="#" id="modal-phone">-</a></span>
          </div>
        </div>

        <div class="modal-message-box">
          <h4><?= ($_SESSION['lang'] == 'en') ? 'Project Description / Message' : 'Description du projet / Message' ?></h4>
          <div class="modal-message-content" id="modal-message">
            ...
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <div class="modal-footer-actions-left">
          <a href="#" class="btn-action btn-reply" id="modal-btn-reply">
            <i class="mdi mdi-reply"></i>
            <span><?= ($_SESSION['lang'] == 'en') ? 'Reply by Email' : 'Répondre par email' ?></span>
          </a>
          <a href="#" class="btn-action btn-call" id="modal-btn-call">
            <i class="mdi mdi-phone"></i>
            <span><?= ($_SESSION['lang'] == 'en') ? 'Call' : 'Appeler' ?></span>
          </a>
        </div>

        <div class="modal-footer-actions-right">
          <button type="button" class="btn-action btn-status-toggle" id="modal-btn-toggle-read">
            <i class="mdi mdi-email-mark-as-unread"></i>
            <span>Marquer comme non lu</span>
          </button>
          <button type="button" class="btn-action btn-modal-delete" id="modal-btn-delete" title="Supprimer">
            <i class="mdi mdi-trash-can-outline"></i>
            <span><?= ($_SESSION['lang'] == 'en') ? 'Delete' : 'Supprimer' ?></span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <?php require_once '../assets/templates/footer.php' ?>

  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/reveal.js"></script>
  <script src="/assets/js/theme.js"></script>
  <script src="/assets/js/custom-select.js"></script>
  <script src="/admin/assets/js/messages.js"></script>
</body>

</html>
