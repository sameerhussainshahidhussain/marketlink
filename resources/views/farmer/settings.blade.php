<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Settings | MarketLink Farmer</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>

  <div class="dashboard-wrapper">
    <div class="sidebar-overlay"></div>

    <aside class="dashboard-sidebar">
      <div class="sidebar-header">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
          <div class="brand-icon" style="width:36px; height:36px; font-size:1.1rem;"><i class="bi bi-flower1"></i></div>
          <span class="brand-title text-white fs-5">MarketLink</span>
        </a>
      </div>

      <ul class="sidebar-menu">
        <li class="sidebar-heading">Vendor Core</li>
        <li class="sidebar-item"><a href="dashboard.html" class="sidebar-link"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a></li>
        <li class="sidebar-item"><a href="orders.html" class="sidebar-link"><i class="bi bi-box2-heart"></i><span>Pre-Orders</span><span class="sidebar-badge">4 New</span></a></li>
        <li class="sidebar-item"><a href="{{ url('/products') }}" class="sidebar-link"><i class="bi bi-calendar-week"></i><span>Weekly Stock</span></a></li>
        <li class="sidebar-item"><a href="add-product.html" class="sidebar-link"><i class="bi bi-plus-circle"></i><span>Add Produce</span></a></li>
        <li class="sidebar-item"><a href="pickup-slots.html" class="sidebar-link"><i class="bi bi-clock-history"></i><span>Pickup Windows</span></a></li>
        <li class="sidebar-heading mt-3">Performance</li>
        <li class="sidebar-item"><a href="insights.html" class="sidebar-link"><i class="bi bi-graph-up-arrow"></i><span>Sales & Insights</span></a></li>
        <li class="sidebar-item"><a href="reviews.html" class="sidebar-link"><i class="bi bi-star"></i><span>Stall Reviews</span></a></li>
        <li class="sidebar-item"><a href="profile.html" class="sidebar-link"><i class="bi bi-shop"></i><span>Stall Profile</span></a></li>
        <li class="sidebar-item"><a href="settings.html" class="sidebar-link active"><i class="bi bi-gear"></i><span>Settings</span></a></li>
        <li class="sidebar-heading mt-3">Account</li>
        <li class="sidebar-item"><a href="{{ url('/login') }}" class="sidebar-link text-danger"><i class="bi bi-box-arrow-left text-danger"></i><span>Sign Out</span></a></li>
      </ul>
    </aside>

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Vendor Operational Settings</h5>
        </div>
      </header>

      <div class="dashboard-container">
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="content-card">
              <div class="content-card-header">
                <h5 class="font-serif mb-0">Stall Operations & Notifications</h5>
              </div>
              <div class="content-card-body">
                <form onsubmit="event.preventDefault(); showToast('Vendor settings saved successfully!', 'success');">
                  <h6 class="font-serif text-forest mb-3">In-Person Payment Methods Accepted at Stall</h6>
                  <p class="small text-muted mb-3">Inform shoppers what methods they can use when collecting their pre-orders:</p>
                  
                  <div class="row g-2 mb-4">
                    <div class="col-sm-4">
                      <div class="form-check p-3 border rounded-16 bg-cream">
                        <input class="form-check-input ms-0 me-2" type="checkbox" id="payCash" checked>
                        <label class="form-check-label small fw-bold" for="payCash">Cash</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check p-3 border rounded-16 bg-cream">
                        <input class="form-check-input ms-0 me-2" type="checkbox" id="paySquare" checked>
                        <label class="form-check-label small fw-bold" for="paySquare">Card (Stall POS)</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check p-3 border rounded-16 bg-cream">
                        <input class="form-check-input ms-0 me-2" type="checkbox" id="payVenmo" checked>
                        <label class="form-check-label small fw-bold" for="payVenmo">Venmo / Zelle</label>
                      </div>
                    </div>
                  </div>

                  <h6 class="font-serif text-forest mb-3 border-top pt-3">Notification Preferences</h6>
                  <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="notifNewOrder" checked>
                    <label class="form-check-label small" for="notifNewOrder">Instant SMS notification when a new customer pre-order is placed</label>
                  </div>
                  <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="notifCutoff" checked>
                    <label class="form-check-label small" for="notifCutoff">Reminder alert when weekly cutoff window closes (to pack crates)</label>
                  </div>
                  <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="notifReview" checked>
                    <label class="form-check-label small" for="notifReview">Alert when a shopper posts a review or rating for your produce</label>
                  </div>

                  <button type="submit" class="btn btn-forest rounded-pill px-4 py-2">
                    <i class="bi bi-check2 me-1"></i> Save Settings
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>
</html>
