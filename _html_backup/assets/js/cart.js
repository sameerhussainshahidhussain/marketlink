/**
 * MarketLink - Cart & Pre-Order Management
 * Frontend state management using localStorage
 * (Payment is settled in person at pickup as per SRS requirements)
 */

const CartService = {
  getCart() {
    return JSON.parse(localStorage.getItem('marketlink_cart') || '[]');
  },

  saveCart(cart) {
    localStorage.setItem('marketlink_cart', JSON.stringify(cart));
    if (typeof updateGlobalBadges === 'function') {
      updateGlobalBadges();
    }
  },

  addItem(item) {
    const cart = this.getCart();
    const existing = cart.find(i => i.id === item.id);

    if (existing) {
      existing.qty = (existing.qty || 1) + (item.qty || 1);
    } else {
      cart.push({
        id: item.id,
        name: item.name,
        price: parseFloat(item.price),
        unit: item.unit || 'per item',
        farmer: item.farmer || 'Local Farm',
        market: item.market || 'Valley Farmers Market',
        image: item.image || 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=400&auto=format&fit=crop&q=80',
        qty: item.qty || 1
      });
    }

    this.saveCart(cart);
    if (typeof showToast === 'function') {
      showToast(`Added <strong>${item.name}</strong> to your basket!`, 'success', 'bi-bag-check-fill');
    }
  },

  removeItem(id) {
    let cart = this.getCart();
    const item = cart.find(i => i.id === id);
    cart = cart.filter(i => i.id !== id);
    this.saveCart(cart);
    if (typeof showToast === 'function' && item) {
      showToast(`Removed <strong>${item.name}</strong> from your basket`, 'warning');
    }
    this.renderCartPage();
    this.renderCheckoutSummary();
  },

  updateQty(id, delta) {
    const cart = this.getCart();
    const item = cart.find(i => i.id === id);
    if (item) {
      item.qty += delta;
      if (item.qty <= 0) {
        this.removeItem(id);
        return;
      }
    }
    this.saveCart(cart);
    this.renderCartPage();
    this.renderCheckoutSummary();
  },

  clearCart() {
    localStorage.removeItem('marketlink_cart');
    if (typeof updateGlobalBadges === 'function') {
      updateGlobalBadges();
    }
  },

  getTotals() {
    const cart = this.getCart();
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    const itemCount = cart.reduce((sum, item) => sum + item.qty, 0);
    return {
      subtotal: subtotal.toFixed(2),
      itemCount,
      total: subtotal.toFixed(2)
    };
  },

  renderCartPage() {
    const container = document.getElementById('cartItemsList');
    if (!container) return;

    const cart = this.getCart();
    const totals = this.getTotals();

    if (cart.length === 0) {
      container.innerHTML = `
        <div class="empty-state my-4 p-5 text-center">
          <div class="empty-icon mx-auto mb-3">
            <i class="bi bi-basket3 text-muted"></i>
          </div>
          <h4 class="font-serif">Your Basket is Empty</h4>
          <p class="text-muted mb-4">Discover freshly harvested seasonal produce from verified local farmers near you.</p>
          <a href="../pages/products.html" class="btn btn-forest px-4 py-2">
            <i class="bi bi-search me-1"></i> Browse Fresh Produce
          </a>
        </div>
      `;
      const summaryCard = document.getElementById('cartSummaryCard');
      if (summaryCard) summaryCard.style.display = 'none';
      return;
    }

    const summaryCard = document.getElementById('cartSummaryCard');
    if (summaryCard) summaryCard.style.display = 'block';

    let html = '';
    cart.forEach(item => {
      const lineTotal = (item.price * item.qty).toFixed(2);
      html += `
        <div class="card mb-3 border-subtle rounded-16 shadow-xs p-3">
          <div class="row align-items-center g-3">
            <div class="col-3 col-md-2">
              <img src="${item.image}" alt="${item.name}" class="img-fluid rounded-12 object-fit-cover" style="height: 75px; width: 100%;">
            </div>
            <div class="col-9 col-md-4">
              <span class="badge bg-sage text-forest mb-1 small">${item.farmer}</span>
              <h6 class="mb-1 font-serif fs-6">${item.name}</h6>
              <div class="text-muted small"><i class="bi bi-geo-alt me-1"></i>${item.market}</div>
              <div class="fw-bold text-forest mt-1">$${item.price.toFixed(2)} <span class="small fw-normal text-muted">/${item.unit}</span></div>
            </div>
            <div class="col-6 col-md-3">
              <div class="d-flex align-items-center border rounded-pill p-1 justify-content-between" style="max-width: 130px; background: #fff;">
                <button class="btn btn-sm btn-icon" onclick="CartService.updateQty('${item.id}', -1)" aria-label="Decrease">
                  <i class="bi bi-dash"></i>
                </button>
                <span class="fw-bold px-2">${item.qty}</span>
                <button class="btn btn-sm btn-icon" onclick="CartService.updateQty('${item.id}', 1)" aria-label="Increase">
                  <i class="bi bi-plus"></i>
                </button>
              </div>
            </div>
            <div class="col-4 col-md-2 text-end">
              <div class="fw-bold fs-6 text-forest">$${lineTotal}</div>
            </div>
            <div class="col-2 col-md-1 text-end">
              <button class="btn btn-outline-danger btn-sm rounded-circle" onclick="CartService.removeItem('${item.id}')" title="Remove item">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </div>
        </div>
      `;
    });

    container.innerHTML = html;

    // Update Totals in DOM
    const subtotalEl = document.getElementById('cartSubtotal');
    const totalEl = document.getElementById('cartTotal');
    const countEl = document.getElementById('cartItemCount');

    if (subtotalEl) subtotalEl.textContent = `$${totals.subtotal}`;
    if (totalEl) totalEl.textContent = `$${totals.total}`;
    if (countEl) countEl.textContent = `${totals.itemCount} ${totals.itemCount === 1 ? 'item' : 'items'}`;
  },

  renderCheckoutSummary() {
    const summaryContainer = document.getElementById('checkoutOrderReview');
    if (!summaryContainer) return;

    const cart = this.getCart();
    const totals = this.getTotals();

    if (cart.length === 0) {
      summaryContainer.innerHTML = '<p class="text-muted">No items in your basket to preorder.</p>';
      return;
    }

    let itemsHtml = '<ul class="list-group list-group-flush mb-3">';
    cart.forEach(item => {
      itemsHtml += `
        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
          <div>
            <span class="fw-semibold">${item.name}</span>
            <div class="small text-muted">${item.qty} &times; $${item.price.toFixed(2)} (${item.farmer})</div>
          </div>
          <span class="fw-bold text-forest">$${(item.price * item.qty).toFixed(2)}</span>
        </li>
      `;
    });
    itemsHtml += '</ul>';

    summaryContainer.innerHTML = itemsHtml;

    const checkoutTotal = document.getElementById('checkoutTotalAmount');
    if (checkoutTotal) checkoutTotal.textContent = `$${totals.total}`;
  }
};

// Global Add to Cart helper
window.addToCartClicked = function(id, name, price, unit, farmer, market, image) {
  CartService.addItem({
    id,
    name,
    price,
    unit,
    farmer,
    market,
    image,
    qty: 1
  });
};

document.addEventListener('DOMContentLoaded', () => {
  CartService.renderCartPage();
  CartService.renderCheckoutSummary();
});
