/**
 * MarketLink - Dashboard Controller
 * Powers Customer, Farmer, and Admin dashboards
 */

document.addEventListener('DOMContentLoaded', () => {
  initSidebarToggle();
  initFarmerCharts();
  initAdminCharts();
  initInteractiveDashboardActions();
});

// Sidebar Toggle for Mobile View
function initSidebarToggle() {
  const toggleBtn = document.getElementById('sidebarToggleBtn');
  const sidebar = document.querySelector('.dashboard-sidebar');
  const overlay = document.querySelector('.sidebar-overlay');

  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('show');
      if (overlay) overlay.classList.toggle('show');
    });
  }

  if (overlay && sidebar) {
    overlay.addEventListener('click', () => {
      sidebar.classList.remove('show');
      overlay.classList.remove('show');
    });
  }
}

// Chart.js for Farmer Insights
function initFarmerCharts() {
  const weeklyChartCtx = document.getElementById('farmerWeeklyOrdersChart');
  if (weeklyChartCtx && typeof Chart !== 'undefined') {
    new Chart(weeklyChartCtx, {
      type: 'bar',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Pre-Orders Completed',
          data: [12, 19, 15, 25, 42, 68, 55],
          backgroundColor: '#245e3f',
          borderRadius: 8
        }, {
          label: 'Pending Pickups',
          data: [4, 6, 8, 10, 15, 20, 18],
          backgroundColor: '#c59b27',
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        },
        scales: {
          y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
          x: { grid: { display: false } }
        }
      }
    });
  }

  const salesRevenueCtx = document.getElementById('farmerRevenueChart');
  if (salesRevenueCtx && typeof Chart !== 'undefined') {
    new Chart(salesRevenueCtx, {
      type: 'line',
      data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
          label: 'Estimated Sales ($)',
          data: [720, 940, 1150, 1420],
          borderColor: '#14351d',
          backgroundColor: 'rgba(56, 163, 115, 0.1)',
          fill: true,
          tension: 0.35,
          borderWidth: 3
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  }
}

// Chart.js for Admin Analytics
function initAdminCharts() {
  const adminMarketCtx = document.getElementById('adminPlatformActivityChart');
  if (adminMarketCtx && typeof Chart !== 'undefined') {
    new Chart(adminMarketCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [
          {
            label: 'Active Customers',
            data: [210, 340, 520, 780, 1100, 1450],
            borderColor: '#245e3f',
            tension: 0.3,
            borderWidth: 3
          },
          {
            label: 'Registered Farmers',
            data: [15, 22, 35, 48, 62, 75],
            borderColor: '#c59b27',
            tension: 0.3,
            borderWidth: 3
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });
  }
}

// Interactive UI triggers
function initInteractiveDashboardActions() {
  // Sold Out toggle
  document.querySelectorAll('.btn-toggle-sold-out').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const badge = btn.closest('tr')?.querySelector('.stock-badge') || btn.closest('.card')?.querySelector('.stock-badge');
      if (badge) {
        if (badge.classList.contains('stock-out')) {
          badge.className = 'stock-badge stock-in';
          badge.innerHTML = '<i class="bi bi-circle-fill"></i> In Stock';
          btn.textContent = 'Mark Sold Out';
          if (typeof showToast === 'function') showToast('Product marked as <strong>In Stock</strong>', 'success');
        } else {
          badge.className = 'stock-badge stock-out';
          badge.innerHTML = '<i class="bi bi-circle-fill"></i> Sold Out';
          btn.textContent = 'Mark Available';
          if (typeof showToast === 'function') showToast('Product marked as <strong>Sold Out</strong>', 'warning');
        }
      }
    });
  });

  // Farmer Order Accept / Decline
  document.querySelectorAll('.btn-order-action').forEach(btn => {
    btn.addEventListener('click', () => {
      const action = btn.getAttribute('data-action');
      const orderId = btn.getAttribute('data-order') || '#ORD-8821';
      const badge = btn.closest('tr')?.querySelector('.badge-status');

      if (action === 'accept') {
        if (badge) {
          badge.className = 'badge-status accepted';
          badge.textContent = 'Accepted';
        }
        btn.parentElement.innerHTML = `<span class="badge bg-success-subtle text-success p-2"><i class="bi bi-check2"></i> Accepted</span>`;
        if (typeof showToast === 'function') showToast(`Order <strong>${orderId}</strong> accepted! Customer notified.`, 'success');
      } else if (action === 'ready') {
        if (badge) {
          badge.className = 'badge-status ready';
          badge.textContent = 'Ready for Pickup';
        }
        btn.parentElement.innerHTML = `<span class="badge bg-primary-subtle text-primary p-2"><i class="bi bi-box2-heart"></i> Ready</span>`;
        if (typeof showToast === 'function') showToast(`Order <strong>${orderId}</strong> is marked ready for pickup!`, 'success');
      } else if (action === 'decline') {
        if (badge) {
          badge.className = 'badge-status cancelled';
          badge.textContent = 'Declined';
        }
        btn.parentElement.innerHTML = `<span class="badge bg-danger-subtle text-danger p-2">Declined</span>`;
        if (typeof showToast === 'function') showToast(`Order <strong>${orderId}</strong> declined.`, 'danger');
      }
    });
  });

  // Admin Farmer Approval
  document.querySelectorAll('.btn-admin-farmer-action').forEach(btn => {
    btn.addEventListener('click', () => {
      const action = btn.getAttribute('data-action');
      const farmerName = btn.getAttribute('data-farmer') || 'Farmer Stall';
      const badge = btn.closest('tr')?.querySelector('.badge-status');

      if (action === 'approve') {
        if (badge) {
          badge.className = 'badge-status approved';
          badge.textContent = 'Approved';
        }
        btn.parentElement.innerHTML = `<span class="text-success small fw-bold"><i class="bi bi-patch-check-fill"></i> Approved</span>`;
        if (typeof showToast === 'function') showToast(`Farmer stall <strong>${farmerName}</strong> has been approved!`, 'success');
      } else if (action === 'suspend') {
        if (badge) {
          badge.className = 'badge-status suspended';
          badge.textContent = 'Suspended';
        }
        btn.parentElement.innerHTML = `<span class="text-danger small fw-bold">Suspended</span>`;
        if (typeof showToast === 'function') showToast(`Farmer stall <strong>${farmerName}</strong> suspended.`, 'danger');
      }
    });
  });
}
