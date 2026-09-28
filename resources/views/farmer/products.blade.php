<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weekly Stock Management | MarketLink Farmer</title>

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
        <li class="sidebar-item"><a href="{{ url('/products') }}" class="sidebar-link active"><i class="bi bi-calendar-week"></i><span>Weekly Stock</span></a></li>
        <li class="sidebar-item"><a href="add-product.html" class="sidebar-link"><i class="bi bi-plus-circle"></i><span>Add Produce</span></a></li>
        <li class="sidebar-item"><a href="pickup-slots.html" class="sidebar-link"><i class="bi bi-clock-history"></i><span>Pickup Windows</span></a></li>
        <li class="sidebar-heading mt-3">Performance</li>
        <li class="sidebar-item"><a href="insights.html" class="sidebar-link"><i class="bi bi-graph-up-arrow"></i><span>Sales & Insights</span></a></li>
        <li class="sidebar-item"><a href="reviews.html" class="sidebar-link"><i class="bi bi-star"></i><span>Stall Reviews</span></a></li>
        <li class="sidebar-item"><a href="profile.html" class="sidebar-link"><i class="bi bi-shop"></i><span>Stall Profile</span></a></li>
        <li class="sidebar-item"><a href="settings.html" class="sidebar-link"><i class="bi bi-gear"></i><span>Settings</span></a></li>
        <li class="sidebar-heading mt-3">Account</li>
        <li class="sidebar-item"><a href="{{ url('/login') }}" class="sidebar-link text-danger"><i class="bi bi-box-arrow-left text-danger"></i><span>Sign Out</span></a></li>
      </ul>
    </aside>

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Weekly Harvest Stock Management</h5>
        </div>
        <div class="topbar-right">
          <a href="add-product.html" class="btn btn-sm btn-forest rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Add Produce Item
          </a>
        </div>
      </header>

      <div class="dashboard-container">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
          <div>
            <h4 class="font-serif mb-1">Stall #04 Harvest Inventory</h4>
            <p class="small text-muted mb-0">Update weekly harvest stock counts, units, and availability before Saturday cutoff.</p>
          </div>
          <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-forest rounded-pill px-3" onclick="showToast('Weekly template cloned for upcoming weekend market!', 'success')">
              <i class="bi bi-arrow-repeat me-1"></i> Repeat Last Week's Stock
            </button>
          </div>
        </div>

        <div class="content-card">
          <div class="table-responsive">
            <table class="table table-custom">
              <thead>
                <tr>
                  <th>Produce Item</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Unit</th>
                  <th>Quantity In Stock</th>
                  <th>Availability</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <img src="https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=100&auto=format&fit=crop&q=80" class="rounded-12" style="width:48px; height:48px; object-fit:cover;">
                      <div>
                        <h6 class="mb-0 fs-6">Vine-Ripened Heirloom Tomatoes</h6>
                        <small class="text-muted">Cherokee Purple, Green Zebra</small>
                      </div>
                    </div>
                  </td>
                  <td><span class="badge bg-sage text-forest small">Vegetables</span></td>
                  <td><strong>$4.50</strong></td>
                  <td>pound (lb)</td>
                  <td><strong class="text-forest">35 lbs</strong></td>
                  <td><span class="stock-badge stock-in"><i class="bi bi-circle-fill"></i> In Stock</span></td>
                  <td class="text-end">
                    <div class="d-flex gap-1 justify-content-end">
                      <button class="btn btn-sm btn-outline-secondary rounded-pill btn-toggle-sold-out">Mark Sold Out</button>
                      <a href="add-product.html?id=p1" class="btn btn-sm btn-outline-forest rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <img src="https://images.unsplash.com/photo-1524179091875-bf99a9a6af57?w=100&auto=format&fit=crop&q=80" class="rounded-12" style="width:48px; height:48px; object-fit:cover;">
                      <div>
                        <h6 class="mb-0 fs-6">Tender Baby Curly Kale Bunch</h6>
                        <small class="text-muted">Fresh snipped Friday</small>
                      </div>
                    </div>
                  </td>
                  <td><span class="badge bg-sage text-forest small">Vegetables</span></td>
                  <td><strong>$2.75</strong></td>
                  <td>bunch</td>
                  <td><strong class="text-forest">40 bunches</strong></td>
                  <td><span class="stock-badge stock-in"><i class="bi bi-circle-fill"></i> In Stock</span></td>
                  <td class="text-end">
                    <div class="d-flex gap-1 justify-content-end">
                      <button class="btn btn-sm btn-outline-secondary rounded-pill btn-toggle-sold-out">Mark Sold Out</button>
                      <a href="add-product.html?id=p6" class="btn btn-sm btn-outline-forest rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <img src="https://images.unsplash.com/photo-1618164435735-413d3b066c9a?w=100&auto=format&fit=crop&q=80" class="rounded-12" style="width:48px; height:48px; object-fit:cover;">
                      <div>
                        <h6 class="mb-0 fs-6">Fresh Organic Sweet Basil Bunch</h6>
                        <small class="text-muted">Genovese Sweet</small>
                      </div>
                    </div>
                  </td>
                  <td><span class="badge bg-sage text-forest small">Herbs</span></td>
                  <td><strong>$3.20</strong></td>
                  <td>bunch</td>
                  <td><strong class="text-forest">28 bunches</strong></td>
                  <td><span class="stock-badge stock-in"><i class="bi bi-circle-fill"></i> In Stock</span></td>
                  <td class="text-end">
                    <div class="d-flex gap-1 justify-content-end">
                      <button class="btn btn-sm btn-outline-secondary rounded-pill btn-toggle-sold-out">Mark Sold Out</button>
                      <a href="add-product.html?id=p8" class="btn btn-sm btn-outline-forest rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=100&auto=format&fit=crop&q=80" class="rounded-12" style="width:48px; height:48px; object-fit:cover;">
                      <div>
                        <h6 class="mb-0 fs-6">Rainbow Heirloom Baby Carrots</h6>
                        <small class="text-muted">Purple, Yellow & Orange</small>
                      </div>
                    </div>
                  </td>
                  <td><span class="badge bg-sage text-forest small">Vegetables</span></td>
                  <td><strong>$3.50</strong></td>
                  <td>bunch</td>
                  <td><strong class="text-forest">0 bunches</strong></td>
                  <td><span class="stock-badge stock-out"><i class="bi bi-circle-fill"></i> Sold Out</span></td>
                  <td class="text-end">
                    <div class="d-flex gap-1 justify-content-end">
                      <button class="btn btn-sm btn-outline-secondary rounded-pill btn-toggle-sold-out">Mark Available</button>
                      <a href="add-product.html" class="btn btn-sm btn-outline-forest rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
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
