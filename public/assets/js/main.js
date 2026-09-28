/**
 * MarketLink - eGreen Basket
 * Global Main JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  initNavbarScroll();
  initToastContainer();
  updateGlobalBadges();
  initFavoriteButtons();
});

// Navbar Scroll Effect
function initNavbarScroll() {
  const navbar = document.querySelector('.marketlink-navbar');
  if (!navbar) return;

  const handleScroll = () => {
    if (window.scrollY > 40) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  };

  window.addEventListener('scroll', handleScroll);
  handleScroll();
}

// Toast Notification System
function initToastContainer() {
  if (!document.getElementById('marketlinkToastContainer')) {
    const container = document.createElement('div');
    container.id = 'marketlinkToastContainer';
    container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    container.style.zIndex = '1090';
    document.body.appendChild(container);
  }
}

function showToast(message, type = 'success', icon = 'bi-check-circle-fill') {
  initToastContainer();
  const container = document.getElementById('marketlinkToastContainer');
  
  const toastId = 'toast_' + Date.now();
  const iconClass = type === 'success' ? 'text-success bi-check-circle-fill' :
                    type === 'warning' ? 'text-warning bi-exclamation-triangle-fill' :
                    type === 'danger' ? 'text-danger bi-x-circle-fill' : 'text-primary bi-info-circle-fill';

  const toastHtml = `
    <div id="${toastId}" class="toast toast-custom ${type} align-items-center show" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body d-flex align-items-center gap-2">
          <i class="bi ${iconClass} fs-5"></i>
          <div>${message}</div>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  `;

  container.insertAdjacentHTML('beforeend', toastHtml);
  const toastElement = document.getElementById(toastId);

  setTimeout(() => {
    if (toastElement) {
      toastElement.classList.remove('show');
      setTimeout(() => toastElement.remove(), 400);
    }
  }, 3500);

  const closeBtn = toastElement.querySelector('.btn-close');
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      toastElement.remove();
    });
  }
}

// Update Global Badges (Cart & Favorites)
function updateGlobalBadges() {
  // Cart Badge
  const cart = JSON.parse(localStorage.getItem('marketlink_cart') || '[]');
  const totalItems = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
  document.querySelectorAll('.cart-badge-count').forEach(el => {
    el.textContent = totalItems;
    el.style.display = totalItems > 0 ? 'inline-block' : 'none';
  });

  // Favorites Badge
  const favs = JSON.parse(localStorage.getItem('marketlink_favs') || '[]');
  document.querySelectorAll('.fav-badge-count').forEach(el => {
    el.textContent = favs.length;
    el.style.display = favs.length > 0 ? 'inline-block' : 'none';
  });
}

// Global Favorites Toggle
function initFavoriteButtons() {
  document.addEventListener('click', (e) => {
    const favBtn = e.target.closest('.favorite-btn');
    if (!favBtn) return;

    e.preventDefault();
    e.stopPropagation();

    const itemId = favBtn.getAttribute('data-id') || 'item_' + Math.floor(Math.random()*1000);
    const itemName = favBtn.getAttribute('data-name') || 'Item';
    const itemType = favBtn.getAttribute('data-type') || 'product';

    let favs = JSON.parse(localStorage.getItem('marketlink_favs') || '[]');
    const index = favs.findIndex(f => f.id === itemId);

    if (index > -1) {
      favs.splice(index, 1);
      favBtn.classList.remove('active');
      const icon = favBtn.querySelector('i');
      if (icon) {
        icon.className = 'bi bi-heart';
      }
      showToast(`Removed <strong>${itemName}</strong> from your favorites`, 'warning', 'bi-heartbreak-fill');
    } else {
      favs.push({ id: itemId, name: itemName, type: itemType, timestamp: Date.now() });
      favBtn.classList.add('active');
      const icon = favBtn.querySelector('i');
      if (icon) {
        icon.className = 'bi bi-heart-fill text-danger';
      }
      showToast(`Saved <strong>${itemName}</strong> to your favorites!`, 'success', 'bi-heart-fill');
    }

    localStorage.setItem('marketlink_favs', JSON.stringify(favs));
    updateGlobalBadges();
  });

  // Initialize favorite buttons active states on page load
  const favs = JSON.parse(localStorage.getItem('marketlink_favs') || '[]');
  document.querySelectorAll('.favorite-btn').forEach(btn => {
    const id = btn.getAttribute('data-id');
    if (id && favs.some(f => f.id === id)) {
      btn.classList.add('active');
      const icon = btn.querySelector('i');
      if (icon) icon.className = 'bi bi-heart-fill text-danger';
    }
  });
}
