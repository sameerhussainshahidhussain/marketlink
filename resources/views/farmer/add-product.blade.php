<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Harvest Produce | MarketLink Farmer</title>

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
        <li class="sidebar-item"><a href="add-product.html" class="sidebar-link active"><i class="bi bi-plus-circle"></i><span>Add Produce</span></a></li>
        <li class="sidebar-item"><a href="pickup-slots.html" class="sidebar-link"><i class="bi bi-clock-history"></i><span>Pickup Windows</span></a></li>
        <li class="sidebar-heading mt-3">Account</li>
        <li class="sidebar-item"><a href="{{ url('/login') }}" class="sidebar-link text-danger"><i class="bi bi-box-arrow-left text-danger"></i><span>Sign Out</span></a></li>
      </ul>
    </aside>

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Add New Harvest Produce</h5>
        </div>
        <div class="topbar-right">
          <a href="{{ url('/products') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Inventory
          </a>
        </div>
      </header>

      <div class="dashboard-container">
        <div class="row g-4">
          
          <div class="col-lg-7">
            <div class="content-card">
              <div class="content-card-header">
                <h5 class="font-serif mb-0">Produce Information</h5>
                <span class="small text-muted">Stall #04 &bull; Valley Green Market</span>
              </div>
              <div class="content-card-body">
                <form id="addProductForm" onsubmit="event.preventDefault(); showToast('New produce item added to weekly stock!', 'success'); setTimeout(() => window.location.href="{{ url('/products') }}", 800);">
                  <div class="mb-3">
                    <label class="form-label small fw-bold">Produce Name <span class="text-danger">*</span></label>
                    <input type="text" id="inputProdName" class="form-control rounded-12" placeholder="e.g. Organic Crisp Romanesco Broccoli" value="Organic Romanesco Broccoli" required oninput="updateLivePreview()">
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Category <span class="text-danger">*</span></label>
                      <select id="inputProdCat" class="form-select rounded-12" required onchange="updateLivePreview()">
                        <option value="Vegetables" selected>Vegetables</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Dairy & Cheese">Dairy & Cheese</option>
                        <option value="Eggs">Eggs</option>
                        <option value="Raw Honey">Raw Honey</option>
                        <option value="Baked Goods">Baked Goods</option>
                        <option value="Herbs">Herbs</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Designated Market <span class="text-danger">*</span></label>
                      <select class="form-select rounded-12">
                        <option selected>Valley Green Community Market (Stall #04)</option>
                        <option>Riverfront Organic Farmers Bazaar</option>
                      </select>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-4">
                      <label class="form-label small fw-bold">Price ($) <span class="text-danger">*</span></label>
                      <input type="number" id="inputProdPrice" step="0.05" class="form-control rounded-12" value="3.90" required oninput="updateLivePreview()">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label small fw-bold">Unit <span class="text-danger">*</span></label>
                      <select id="inputProdUnit" class="form-select rounded-12" required onchange="updateLivePreview()">
                        <option value="head" selected>per head</option>
                        <option value="lb">per lb</option>
                        <option value="bunch">per bunch</option>
                        <option value="dozen">per dozen</option>
                        <option value="jar">per jar</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label small fw-bold">Quantity Available <span class="text-danger">*</span></label>
                      <input type="number" id="inputProdQty" class="form-control rounded-12" value="20" required oninput="updateLivePreview()">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small fw-bold">Availability State</label>
                    <select id="inputProdStockState" class="form-select rounded-12" onchange="updateLivePreview()">
                      <option value="In Stock" selected>In Stock</option>
                      <option value="Low Stock">Low Stock</option>
                      <option value="Sold Out">Sold Out</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small fw-bold">Produce Description <span class="text-danger">*</span></label>
                    <textarea id="inputProdDesc" class="form-control rounded-12" rows="3" placeholder="Highlight harvest day, taste profile, and preparation suggestions..." required oninput="updateLivePreview()">Geometric emerald Romanesco florets with nutty, sweet flavor. Harvested Friday evening for Saturday market pickup.</textarea>
                  </div>

                  <div class="mb-4">
                    <label class="form-label small fw-bold">Image URL</label>
                    <input type="url" id="inputProdImg" class="form-control rounded-12" value="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=500&auto=format&fit=crop&q=80" oninput="updateLivePreview()">
                    <div class="form-text small">Image will update live on the shopper preview card.</div>
                  </div>

                  <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-forest rounded-pill px-4 py-2">
                      <i class="bi bi-check2-circle me-1"></i> Save to Weekly Stock
                    </button>
                    <a href="{{ url('/products') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">Cancel</a>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="sticky-top" style="top: 100px;">
              <h6 class="font-serif mb-2 text-forest"><i class="bi bi-eye text-emerald me-1"></i> Live Shopper View Preview</h6>
              <p class="small text-muted mb-3">This is exactly how conscious shoppers will see your harvest item on the public catalog and stall page.</p>

              <div class="product-card shadow-md">
                <div class="card-image-wrap">
                  <span class="card-badge-top stock-in" id="previewStockBadge">
                    <i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> <span id="previewStockText">In Stock</span>
                  </span>
                  <button class="favorite-btn" aria-label="Favorite"><i class="bi bi-heart"></i></button>
                  <img id="previewImage" src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=500&auto=format&fit=crop&q=80" alt="Preview Image" class="card-img-top">
                </div>
                <div class="card-body-custom">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="text-muted small text-uppercase fw-bold" id="previewCategory">Vegetables</span>
                    <div class="d-flex align-items-center text-gold small">
                      <i class="bi bi-star-fill me-1"></i> <span class="fw-bold text-dark">5.0</span>
                    </div>
                  </div>
                  <h5 class="card-title font-serif fs-6 mb-1 text-forest" id="previewTitle">Organic Romanesco Broccoli</h5>
                  <p class="text-muted small mb-2"><i class="bi bi-shop me-1 text-emerald"></i>Vance Heritage Organic Farm</p>
                  <p class="small text-muted mb-3" id="previewDescription">Geometric emerald Romanesco florets with nutty, sweet flavor.</p>
                  <div class="d-flex align-items-baseline justify-content-between mt-auto pt-2 border-top">
                    <div>
                      <span class="product-price" id="previewPrice">$3.90</span>
                      <span class="product-unit" id="previewUnit">/head</span>
                    </div>
                    <button class="btn btn-sm btn-forest rounded-pill px-3" disabled>
                      <i class="bi bi-basket me-1"></i> Add
                    </button>
                  </div>
                </div>
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
  <script>
    function updateLivePreview() {
      const name = document.getElementById('inputProdName').value || 'Produce Name';
      const cat = document.getElementById('inputProdCat').value;
      const price = parseFloat(document.getElementById('inputProdPrice').value || 0).toFixed(2);
      const unit = document.getElementById('inputProdUnit').value;
      const desc = document.getElementById('inputProdDesc').value || 'Fresh organic produce description';
      const img = document.getElementById('inputProdImg').value || 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=500&auto=format&fit=crop&q=80';
      const stock = document.getElementById('inputProdStockState').value;

      document.getElementById('previewTitle').textContent = name;
      document.getElementById('previewCategory').textContent = cat;
      document.getElementById('previewPrice').textContent = `$${price}`;
      document.getElementById('previewUnit').textContent = `/${unit}`;
      document.getElementById('previewDescription').textContent = desc.substring(0, 90) + (desc.length > 90 ? '...' : '');
      document.getElementById('previewImage').src = img;

      const badge = document.getElementById('previewStockBadge');
      const text = document.getElementById('previewStockText');
      text.textContent = stock;
      if (stock === 'In Stock') {
        badge.className = 'card-badge-top stock-in';
      } else if (stock === 'Low Stock') {
        badge.className = 'card-badge-top stock-low';
      } else {
        badge.className = 'card-badge-top stock-out';
      }
    }
  </script>
</body>
</html>
