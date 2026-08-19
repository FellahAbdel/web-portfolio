document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('search-input');
  const clearSearchBtn = document.getElementById('clear-search');
  const filterPills = document.querySelectorAll('.filter-pill');
  const messageCards = document.querySelectorAll('.message-card');
  const emptyState = document.getElementById('empty-state');
  const modalOverlay = document.getElementById('message-modal');
  const modalCloseBtn = document.getElementById('modal-close-btn');

  // Stats elements
  const statTotal = document.getElementById('stat-total');
  const statUnread = document.getElementById('stat-unread');
  const statRead = document.getElementById('stat-read');
  const countAll = document.getElementById('count-all');
  const countUnread = document.getElementById('count-unread');
  const countRead = document.getElementById('count-read');
  const navTabBadge = document.getElementById('nav-unread-badge');

  // Modal elements
  const modalSender = document.getElementById('modal-sender');
  const modalDate = document.getElementById('modal-date');
  const modalBadge = document.getElementById('modal-badge');
  const modalEmail = document.getElementById('modal-email');
  const modalPhone = document.getElementById('modal-phone');
  const modalMessage = document.getElementById('modal-message');
  const modalBtnReply = document.getElementById('modal-btn-reply');
  const modalBtnCall = document.getElementById('modal-btn-call');
  const modalBtnToggleRead = document.getElementById('modal-btn-toggle-read');
  const modalBtnDelete = document.getElementById('modal-btn-delete');

  let currentFilter = 'all';
  let activeMessageId = null;

  // --- Filtering & Search ---
  function filterMessages() {
    const searchTerm = (searchInput?.value || '').toLowerCase().trim();
    let visibleCount = 0;

    messageCards.forEach((card) => {
      const isRead = card.getAttribute('data-read') === '1';
      const name = (card.getAttribute('data-name') || '').toLowerCase();
      const email = (card.getAttribute('data-email') || '').toLowerCase();
      const phone = (card.getAttribute('data-phone') || '').toLowerCase();
      const text = (card.getAttribute('data-message') || '').toLowerCase();

      // Check status filter
      let matchesFilter = true;
      if (currentFilter === 'unread' && isRead) matchesFilter = false;
      if (currentFilter === 'read' && !isRead) matchesFilter = false;

      // Check search query
      let matchesSearch = true;
      if (searchTerm) {
        matchesSearch =
          name.includes(searchTerm) ||
          email.includes(searchTerm) ||
          phone.includes(searchTerm) ||
          text.includes(searchTerm);
      }

      if (matchesFilter && matchesSearch) {
        card.style.display = 'grid';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (emptyState) {
      emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
    }
  }

  // Search input events
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      if (clearSearchBtn) {
        clearSearchBtn.style.display = searchInput.value ? 'block' : 'none';
      }
      filterMessages();
    });
  }

  if (clearSearchBtn) {
    clearSearchBtn.addEventListener('click', () => {
      searchInput.value = '';
      clearSearchBtn.style.display = 'none';
      filterMessages();
      searchInput.focus();
    });
  }

  // Filter pills events
  filterPills.forEach((pill) => {
    pill.addEventListener('click', () => {
      filterPills.forEach((p) => p.classList.remove('active'));
      pill.classList.add('active');
      currentFilter = pill.getAttribute('data-filter') || 'all';
      filterMessages();
    });
  });

  // --- Update Stats & Badges ---
  function updateStats(stats) {
    if (!stats) return;
    if (statTotal) statTotal.textContent = stats.total;
    if (statUnread) statUnread.textContent = stats.unread;
    if (statRead) statRead.textContent = stats.read;

    if (countAll) countAll.textContent = stats.total;
    if (countUnread) countUnread.textContent = stats.unread;
    if (countRead) countRead.textContent = stats.read;

    if (navTabBadge) {
      navTabBadge.textContent = stats.unread;
      if (stats.unread > 0) {
        navTabBadge.classList.remove('hidden');
      } else {
        navTabBadge.classList.add('hidden');
      }
    }
  }

  // --- Toast Notification ---
  function showToast(message, type = 'success') {
    let container = document.querySelector('.toast-container');
    if (!container) {
      container = document.createElement('div');
      container.className = 'toast-container';
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    const icon =
      type === 'success'
        ? 'mdi-check-circle-outline'
        : 'mdi-alert-circle-outline';
    toast.innerHTML = `<i class="mdi ${icon}"></i> <span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 3500);
  }

  // --- Card Status Update Helper ---
  function setCardReadStatus(card, isRead) {
    card.setAttribute('data-read', isRead ? '1' : '0');
    const badge = card.querySelector('.message-badge');
    const toggleBtn = card.querySelector('.btn-toggle-read');

    if (isRead) {
      card.classList.remove('unread');
      if (badge) {
        badge.className = 'message-badge read-badge';
        badge.innerHTML = '<i class="mdi mdi-check"></i> Lu';
      }
      if (toggleBtn) {
        toggleBtn.title = 'Marquer comme non lu';
        toggleBtn.innerHTML = '<i class="mdi mdi-email-mark-as-unread"></i>';
      }
    } else {
      card.classList.add('unread');
      if (badge) {
        badge.className = 'message-badge unread-badge';
        badge.innerHTML = '<i class="mdi mdi-circle-medium"></i> Non lu';
      }
      if (toggleBtn) {
        toggleBtn.title = 'Marquer comme lu';
        toggleBtn.innerHTML = '<i class="mdi mdi-email-open-outline"></i>';
      }
    }
  }

  // --- Modal Open & Setup ---
  function openModal(card) {
    activeMessageId = card.getAttribute('data-id');
    const name = card.getAttribute('data-name');
    const email = card.getAttribute('data-email');
    const phone = card.getAttribute('data-phone');
    const date = card.getAttribute('data-date');
    const message = card.getAttribute('data-message');
    const isRead = card.getAttribute('data-read') === '1';

    if (modalSender) modalSender.textContent = name;
    if (modalDate) modalDate.textContent = date;
    if (modalEmail) {
      modalEmail.textContent = email;
      modalEmail.href = `mailto:${email}`;
    }
    if (modalPhone) {
      modalPhone.textContent = phone;
      modalPhone.href = `tel:${phone.replace(/\s+/g, '')}`;
    }
    if (modalMessage) modalMessage.textContent = message;

    if (modalBtnReply) {
      modalBtnReply.href = `mailto:${email}?subject=Re: Votre demande de projet web`;
    }
    if (modalBtnCall) {
      modalBtnCall.href = `tel:${phone.replace(/\s+/g, '')}`;
    }

    updateModalStatusView(isRead);

    // If message is unread, automatically mark it as read when opened
    if (!isRead) {
      markMessageAsRead(activeMessageId, card);
    }

    modalOverlay.classList.add('is-active');
    document.body.style.overflow = 'hidden';
  }

  function updateModalStatusView(isRead) {
    if (modalBadge) {
      if (isRead) {
        modalBadge.className = 'message-badge read-badge';
        modalBadge.innerHTML = '<i class="mdi mdi-check"></i> Lu';
      } else {
        modalBadge.className = 'message-badge unread-badge';
        modalBadge.innerHTML = '<i class="mdi mdi-circle-medium"></i> Non lu';
      }
    }

    if (modalBtnToggleRead) {
      modalBtnToggleRead.innerHTML = isRead
        ? '<i class="mdi mdi-email-mark-as-unread"></i> Marquer comme non lu'
        : '<i class="mdi mdi-email-open-outline"></i> Marquer comme lu';
    }
  }

  function closeModal() {
    if (modalOverlay) {
      modalOverlay.classList.remove('is-active');
      document.body.style.overflow = '';
      activeMessageId = null;
    }
  }

  if (modalCloseBtn) {
    modalCloseBtn.addEventListener('click', closeModal);
  }

  if (modalOverlay) {
    modalOverlay.addEventListener('click', (e) => {
      if (e.target === modalOverlay) closeModal();
    });
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modalOverlay?.classList.contains('is-active')) {
      closeModal();
    }
  });

  // --- Backend Actions ---

  // Mark as read
  function markMessageAsRead(id, card) {
    const formData = new FormData();
    formData.append('action', 'mark_read');
    formData.append('id', id);

    fetch('/admin/assets/actions/messageAction.php', {
      method: 'POST',
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          setCardReadStatus(card, true);
          updateStats(data.stats);
          updateModalStatusView(true);
        }
      })
      .catch((err) => console.error('Error marking as read:', err));
  }

  // Toggle Read/Unread
  function toggleMessageRead(id, card) {
    const formData = new FormData();
    formData.append('action', 'toggle_read');
    formData.append('id', id);

    fetch('/admin/assets/actions/messageAction.php', {
      method: 'POST',
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          const isNowRead = data.is_read === 1;
          setCardReadStatus(card, isNowRead);
          updateStats(data.stats);
          if (activeMessageId === id) {
            updateModalStatusView(isNowRead);
          }
          showToast(
            isNowRead
              ? 'Message marqué comme lu'
              : 'Message marqué comme non lu'
          );
          filterMessages();
        }
      })
      .catch((err) => {
        console.error('Error toggling read status:', err);
        showToast('Erreur lors de la mise à jour', 'error');
      });
  }

  // Delete message
  function deleteMessage(id, card) {
    if (!confirm('Voulez-vous vraiment supprimer ce message de contact ?')) {
      return;
    }

    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('id', id);

    fetch('/admin/assets/actions/messageAction.php', {
      method: 'POST',
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          if (activeMessageId === id) {
            closeModal();
          }

          card.style.opacity = '0';
          card.style.transform = 'scale(0.95)';
          card.style.transition = 'all 0.3s ease';

          setTimeout(() => {
            card.remove();
            updateStats(data.stats);
            filterMessages();
          }, 300);

          showToast('Message supprimé avec succès');
        } else {
          showToast(data.error || 'Erreur lors de la suppression', 'error');
        }
      })
      .catch((err) => {
        console.error('Error deleting message:', err);
        showToast('Erreur de communication avec le serveur', 'error');
      });
  }

  // --- Attach Event Listeners to Cards ---
  messageCards.forEach((card) => {
    const id = card.getAttribute('data-id');

    // Click on card body opens modal
    card.addEventListener('click', (e) => {
      // Don't open if clicked on direct action buttons or mail/tel links
      if (
        e.target.closest('.action-btn') ||
        e.target.closest('a')
      ) {
        return;
      }
      openModal(card);
    });

    // View button
    const btnView = card.querySelector('.btn-view');
    if (btnView) {
      btnView.addEventListener('click', (e) => {
        e.stopPropagation();
        openModal(card);
      });
    }

    // Toggle Read Button
    const btnToggle = card.querySelector('.btn-toggle-read');
    if (btnToggle) {
      btnToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleMessageRead(id, card);
      });
    }

    // Delete Button
    const btnDelete = card.querySelector('.btn-delete');
    if (btnDelete) {
      btnDelete.addEventListener('click', (e) => {
        e.stopPropagation();
        deleteMessage(id, card);
      });
    }
  });

  // Modal footer actions
  if (modalBtnToggleRead) {
    modalBtnToggleRead.addEventListener('click', () => {
      if (!activeMessageId) return;
      const card = document.querySelector(
        `.message-card[data-id="${activeMessageId}"]`
      );
      if (card) toggleMessageRead(activeMessageId, card);
    });
  }

  if (modalBtnDelete) {
    modalBtnDelete.addEventListener('click', () => {
      if (!activeMessageId) return;
      const card = document.querySelector(
        `.message-card[data-id="${activeMessageId}"]`
      );
      if (card) deleteMessage(activeMessageId, card);
    });
  }
});
