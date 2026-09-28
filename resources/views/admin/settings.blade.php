<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>System Settings | MarketLink Admin</title>

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
          <div class="brand-icon" style="width:36px; height:36px; font-size:1.1rem; background:#dc3545;"><i class="bi bi-shield-lock"></i></div>
          <span class="brand-title text-white fs-5">MarketLink</span>
        </a>
      </div>

      <ul class="sidebar-menu">
        <li class="sidebar-heading">Platform Governance</li>
        <li class="sidebar-item"><a href="dashboard.html" class="sidebar-link"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a></li>
        <li class="sidebar-item"><a href="{{ url('/farmers') }}" class="sidebar-link"><i class="bi bi-people"></i><span>Manage Farmers</span></a></li>
        <li class="sidebar-item"><a href="customers.html" class="sidebar-link"><i class="bi bi-person-check"></i><span>Customers</span></a></li>
        <li class="sidebar-item"><a href="{{ url('/markets') }}" class="sidebar-link"><i class="bi bi-shop"></i><span>Manage Markets</span></a></li>
        <li class="sidebar-item"><a href="{{ url('/products') }}" class="sidebar-link"><i class="bi bi-shield-exclamation"></i><span>Moderation</span></a></li>
        <li class="sidebar-item"><a href="categories.html" class="sidebar-link"><i class="bi bi-grid"></i><span>Categories</span></a></li>
        <li class="sidebar-item"><a href="reports.html" class="sidebar-link"><i class="bi bi-file-earmark-bar-graph"></i><span>Reports & Analytics</span></a></li>
        <li class="sidebar-item"><a href="announcements.html" class="sidebar-link"><i class="bi bi-megaphone"></i><span>Announcements</span></a></li>
        <li class="sidebar-item"><a href="settings.html" class="sidebar-link active"><i class="bi bi-sliders"></i><span>System Settings</span></a></li>
        <li class="sidebar-heading mt-3">Account</li>
        <li class="sidebar-item"><a href="{{ url('/login') }}" class="sidebar-link text-danger"><i class="bi bi-box-arrow-left text-danger"></i><span>Sign Out</span></a></li>
      </ul>
    </aside>

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">System Configuration & Policies</h5>
        </div>
      </header>

      <div class="dashboard-container">
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="content-card">
              <div class="content-card-header">
                <h5 class="font-serif mb-0">Platform Pre-Order & Moderation Rules</h5>
              </div>
              <div class="content-card-body">
                <form onsubmit="event.preventDefault(); showToast('System settings saved successfully!', 'success');">
                  <div class="mb-3">
                    <label class="form-label small fw-bold">Platform Organization Name</label>
                    <input type="text" class="form-control rounded-12" value="MarketLink – eGreen Basket">
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Default Pre-Order Cutoff Hours</label>
                      <input type="number" class="form-control rounded-12" value="12">
                      <div class="form-text small">Hours prior to market opening when pre-orders close.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Max Allowed Pre-Order Box Capacity / Stall</label>
                      <input type="number" class="form-control rounded-12" value="50">
                    </div>
                  </div>

                  <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="autoApprove" checked>
                    <label class="form-check-label small" for="autoApprove">Require Admin verification before new farmer stalls become visible</label>
                  </div>

                  <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="payPolicy" checked disabled>
                    <label class="form-check-label small" for="payPolicy">Enforce "In-Person Pickup Payment Only" policy (No online payment gateways per SRS)</label>
                  </div>

                  <button type="submit" class="btn btn-forest rounded-pill px-4 py-2">
                    <i class="bi bi-check2 me-1"></i> Save Platform Settings
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
