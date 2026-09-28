<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Farmers Markets | MarketLink – eGreen Basket</title>
  <meta name="description" content="Discover verified regional farmers markets, operating hours, active farmers, and seasonal organic harvests.">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>

  <nav class="navbar navbar-expand-lg marketlink-navbar sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <div class="brand-icon"><i class="bi bi-flower1"></i></div>
        <div>
          <span class="brand-title">MarketLink</span>
          <span class="brand-subtitle">eGreen Basket</span>
        </div>
      </a>

      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNavOffcanvas">
        <i class="bi bi-list fs-1 text-forest"></i>
      </button>

      <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex">
        <ul class="navbar-nav gap-1">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ url('/markets') }}">Markets</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/farmers') }}">Farmers</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/map') }}">Map</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
        </ul>
      </div>

      <div class="d-none d-lg-flex align-items-center gap-3">
        <a href="{{ url('/products') }}" class="nav-action-btn" title="Search"><i class="bi bi-search"></i></a>
        <a href="{{ url('/favorites') }}" class="nav-action-btn" title="Favorites">
          <i class="bi bi-heart"></i>
          <span class="badge-counter fav-badge-count" style="display:none;">0</span>
        </a>
        <a href="{{ url('/cart') }}" class="nav-action-btn" title="Basket">
          <i class="bi bi-basket3"></i>
          <span class="badge-counter cart-badge-count" style="display:none;">0</span>
        </a>

                <div class="dropdown ms-1">
          <button class="btn btn-forest rounded-pill px-3 py-2 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
            <span>Sign In</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-premium border-0 rounded-16 p-2 mt-2">
            <li><span class="dropdown-header text-uppercase small text-muted">Customer Portal</span></li>
            <li><a class="dropdown-item rounded-8 py-2" href="{{ url('/customer/dashboard') }}"><i class="bi bi-speedometer2 me-2 text-emerald"></i>Customer Dashboard</a></li>
            <li><a class="dropdown-item rounded-8 py-2" href="{{ url('/customer/orders') }}"><i class="bi bi-bag-check me-2 text-emerald"></i>My Pre-Orders</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><span class="dropdown-header text-uppercase small text-muted">Farmer & Admin</span></li>
            <li><a class="dropdown-item rounded-8 py-2" href="{{ url('/farmer/dashboard') }}"><i class="bi bi-shop me-2 text-gold"></i>Farmer Portal</a></li>
            <li><a class="dropdown-item rounded-8 py-2" href="{{ url('/admin/dashboard') }}"><i class="bi bi-shield-check me-2 text-danger"></i>Admin Portal</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item rounded-8 py-2" href="{{ url('/login') }}"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In</a></li>
            <li><a class="dropdown-item rounded-8 py-2 text-success fw-bold" href="{{ url('/register') }}"><i class="bi bi-person-plus me-2"></i>Create Free Account</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start border-0" tabindex="-1" id="mobileNavOffcanvas">
    <div class="offcanvas-header bg-forest text-white py-3">
      <div class="d-flex align-items-center gap-2">
        <div class="brand-icon" style="width:36px; height:36px; font-size:1.1rem;"><i class="bi bi-flower1"></i></div>
        <span class="brand-title text-white fs-5">MarketLink</span>
      </div>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-4">
      <ul class="nav flex-column gap-2 mb-4">
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link active fs-6" href="{{ url('/markets') }}">Browse Markets</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/farmers') }}">Browse Farmers</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/products') }}">All Products</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/map') }}">Nearby Map</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/about') }}">About Us</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/contact') }}">Contact</a></li>
      </ul>
      <div class="d-grid gap-2 pt-3 border-top">
        <a href="{{ url('/cart') }}" class="btn btn-sage"><i class="bi bi-basket3 me-2"></i>My Basket</a>
        <a href="{{ url('/login') }}" class="btn btn-outline-forest">Sign In</a>
      </div>
    </div>
  </div>

  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Markets</li>
        </ol>
      </nav>
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <span class="section-tag"><i class="bi bi-shop"></i> Community Gathering Spots</span>
          <h1 class="display-6 font-serif">Discover Verified Regional Farmers Markets</h1>
          <p class="text-muted mb-0">Explore neighborhood markets, meet local organic growers, and schedule pre-order pickups on designated market days.</p>
        </div>
        <div class="col-lg-5">
          <div class="card p-3 rounded-24 border-subtle shadow-sm bg-white">
            <div class="input-group">
              <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
              <input type="text" id="marketSearchInput" class="form-control border-0 shadow-none" placeholder="Search by market name or town...">
              <button class="btn btn-forest rounded-pill px-4">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
          <h4 class="font-serif mb-1">Active Community Markets (4)</h4>
          <p class="text-muted small mb-0">Showing certified farmers markets open for seasonal pickup reservations.</p>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-outline-forest rounded-pill active">All Days</button>
          <button class="btn btn-sm btn-outline-forest rounded-pill">Weekend (Sat/Sun)</button>
          <button class="btn btn-sm btn-outline-forest rounded-pill">Weekday</button>
        </div>
      </div>

      <div class="row g-4" id="marketsGrid">
        
        <div class="col-md-6 col-lg-4">
          <div class="market-card">
            <div class="card-image-wrap">
              <span class="card-badge-top"><i class="bi bi-calendar3"></i> Saturday & Sunday</span>
              <span class="card-badge-distance"><i class="bi bi-compass"></i> 1.8 miles</span>
              <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=600&auto=format&fit=crop&q=80" alt="Valley Green Market" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <h5 class="font-serif fs-5 mb-1"><a href="{{ url('/market-details') }}?id=m1" class="text-forest text-decoration-none">Valley Green Community Market</a></h5>
              <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-emerald"></i>142 Orchard Way, Green Valley</p>
              <p class="small text-muted mb-3">A vibrant weekend gathering of independent growers offering certified heirloom vegetables, pasture-raised eggs, and wood-fired bread.</p>
              <div class="d-flex align-items-center gap-3 py-2 my-2 border-top border-bottom border-subtle small">
                <div><i class="bi bi-clock me-1 text-gold"></i>08:00 AM - 02:00 PM</div>
                <div class="ms-auto"><i class="bi bi-people me-1 text-forest"></i><strong>24</strong> Farmers</div>
              </div>
              <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                <span class="badge bg-sage text-forest px-3 py-2 rounded-pill">140+ Produce items</span>
                <a href="{{ url('/market-details') }}?id=m1" class="btn btn-sm btn-forest rounded-pill px-3">View Market</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="market-card">
            <div class="card-image-wrap">
              <span class="card-badge-top"><i class="bi bi-calendar3"></i> Wednesday & Saturday</span>
              <span class="card-badge-distance"><i class="bi bi-compass"></i> 3.4 miles</span>
              <img src="https://images.unsplash.com/photo-1533900298318-6b8da08a523e?w=600&auto=format&fit=crop&q=80" alt="Riverfront Farmers Bazaar" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <h5 class="font-serif fs-5 mb-1"><a href="{{ url('/market-details') }}?id=m2" class="text-forest text-decoration-none">Riverfront Organic Farmers Bazaar</a></h5>
              <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-emerald"></i>88 Waterfront Esplanade, Riverside</p>
              <p class="small text-muted mb-3">Scenic open-air riverside market showcasing orchard fresh fruits, raw wild blossom honey, grass-fed dairy, and wild mushrooms.</p>
              <div class="d-flex align-items-center gap-3 py-2 my-2 border-top border-bottom border-subtle small">
                <div><i class="bi bi-clock me-1 text-gold"></i>07:30 AM - 01:00 PM</div>
                <div class="ms-auto"><i class="bi bi-people me-1 text-forest"></i><strong>32</strong> Farmers</div>
              </div>
              <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                <span class="badge bg-sage text-forest px-3 py-2 rounded-pill">195+ Produce items</span>
                <a href="{{ url('/market-details') }}?id=m2" class="btn btn-sm btn-forest rounded-pill px-3">View Market</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="market-card">
            <div class="card-image-wrap">
              <span class="card-badge-top"><i class="bi bi-calendar3"></i> Sunday Morning</span>
              <span class="card-badge-distance"><i class="bi bi-compass"></i> 5.2 miles</span>
              <img src="https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=600&auto=format&fit=crop&q=80" alt="Highland Heritage Fair" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <h5 class="font-serif fs-5 mb-1"><a href="{{ url('/market-details') }}?id=m3" class="text-forest text-decoration-none">Highland Heritage Producers Fair</a></h5>
              <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-emerald"></i>500 Hilltop Ridge Rd, Highland Peak</p>
              <p class="small text-muted mb-3">Mountain-valley growers celebrated for pesticide-free heirloom squashes, hand-churned goat cheese, and cold-pressed cider.</p>
              <div class="d-flex align-items-center gap-3 py-2 my-2 border-top border-bottom border-subtle small">
                <div><i class="bi bi-clock me-1 text-gold"></i>09:00 AM - 03:00 PM</div>
                <div class="ms-auto"><i class="bi bi-people me-1 text-forest"></i><strong>18</strong> Farmers</div>
              </div>
              <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                <span class="badge bg-sage text-forest px-3 py-2 rounded-pill">98+ Produce items</span>
                <a href="{{ url('/market-details') }}?id=m3" class="btn btn-sm btn-forest rounded-pill px-3">View Market</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="market-card">
            <div class="card-image-wrap">
              <span class="card-badge-top"><i class="bi bi-calendar3"></i> Friday Afternoon</span>
              <span class="card-badge-distance"><i class="bi bi-compass"></i> 6.0 miles</span>
              <img src="https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=600&auto=format&fit=crop&q=80" alt="Sunnybrook Artisan Market" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <h5 class="font-serif fs-5 mb-1"><a href="{{ url('/market-details') }}?id=m4" class="text-forest text-decoration-none">Sunnybrook Artisan Market</a></h5>
              <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-emerald"></i>210 Meadowlane Plaza, Sunnybrook</p>
              <p class="small text-muted mb-3">Perfect for pre-weekend pickups with freshly harvested greens, berries, natural sourdough loaves, and fresh cut flowers.</p>
              <div class="d-flex align-items-center gap-3 py-2 my-2 border-top border-bottom border-subtle small">
                <div><i class="bi bi-clock me-1 text-gold"></i>02:00 PM - 07:00 PM</div>
                <div class="ms-auto"><i class="bi bi-people me-1 text-forest"></i><strong>28</strong> Farmers</div>
              </div>
              <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                <span class="badge bg-sage text-forest px-3 py-2 rounded-pill">165+ Produce items</span>
                <a href="{{ url('/market-details') }}?id=m4" class="btn btn-sm btn-forest rounded-pill px-3">View Market</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="marketlink-footer">
    <div class="container text-center">
      <p class="mb-2">&copy; 2026 <strong>MarketLink</strong> – Connecting local farmers with local communities.</p>
      <div class="small text-white-50">In-person payment at pickup &bull; Zero credit card fees</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/cart.js') }}"></script>
  <script src="{{ asset('assets/js/ai-assistant.js') }}"></script>
</body>
</html>
