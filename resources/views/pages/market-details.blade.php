<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Valley Green Community Market | MarketLink</title>

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
        <a href="{{ url('/favorites') }}" class="nav-action-btn" title="Favorites"><i class="bi bi-heart"></i><span class="badge-counter fav-badge-count" style="display:none;">0</span></a>
        <a href="{{ url('/cart') }}" class="nav-action-btn" title="Basket"><i class="bi bi-basket3"></i><span class="badge-counter cart-badge-count" style="display:none;">0</span></a>
        <a href="{{ url('/map') }}" class="btn btn-forest"><i class="bi bi-geo-alt-fill text-gold"></i> Find Fresh Near You</a>
      </div>
    </div>
  </nav>

  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/markets') }}">Markets</a></li>
          <li class="breadcrumb-item active" aria-current="page">Valley Green Community Market</li>
        </ol>
      </nav>

      <div class="row g-4 align-items-center">
        <div class="col-lg-7">
          <span class="section-tag"><i class="bi bi-patch-check-fill"></i> Certified Organic Hub</span>
          <h1 class="display-5 font-serif mb-2">Valley Green Community Market</h1>
          <p class="fs-6 text-muted mb-3"><i class="bi bi-geo-alt-fill text-emerald me-1"></i> 142 Orchard Way, Green Valley (1.8 miles away)</p>
          <p class="text-muted">A vibrant weekend gathering of independent growers offering certified heirloom vegetables, pasture-raised eggs, pure raw honey, and wood-fired bread. Pre-orders are ready for quick stall pickup.</p>

          <div class="row g-3 py-3 border-top border-bottom border-subtle my-3">
            <div class="col-4">
              <div class="fw-bold fs-4 text-forest">24</div>
              <div class="small text-muted">Active Farmers</div>
            </div>
            <div class="col-4">
              <div class="fw-bold fs-4 text-forest">140+</div>
              <div class="small text-muted">Harvest Items</div>
            </div>
            <div class="col-4">
              <div class="fw-bold fs-4 text-emerald">Sat & Sun</div>
              <div class="small text-muted">08:00 AM - 02:00 PM</div>
            </div>
          </div>

          <div class="d-flex gap-3">
            <a href="https://maps.google.com" target="_blank" class="btn btn-forest rounded-pill">
              <i class="bi bi-arrow-up-right-circle me-1"></i> Get GPS Directions
            </a>
            <button class="btn btn-outline-forest rounded-pill favorite-btn" data-id="m1" data-name="Valley Green Market" data-type="market" style="position:static; width:auto; height:auto; padding:10px 20px; border-radius:30px;">
              <i class="bi bi-heart me-1"></i> Save Market
            </button>
          </div>
        </div>

        <div class="col-lg-5">
          <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=800&auto=format&fit=crop&q=80" alt="Market Details" class="img-fluid rounded-24 shadow-premium" style="height: 340px; width: 100%; object-fit: cover;">
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
          <span class="section-tag"><i class="bi bi-people"></i> Meet The Stalls</span>
          <h3 class="font-serif">Farmers at this Market</h3>
        </div>
        <a href="{{ url('/farmers') }}" class="btn btn-sm btn-outline-forest">View All Farmers</a>
      </div>

      <div class="row g-4">
        
        <div class="col-md-6 col-lg-4">
          <div class="farmer-card">
            <div class="card-image-wrap">
              <span class="card-badge-top">Stall #04</span>
              <img src="https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=500&auto=format&fit=crop&q=80" class="card-img-top" alt="Vance Farm">
            </div>
            <div class="card-body-custom">
              <h5 class="font-serif fs-6 mb-1">Vance Heritage Organic Farm</h5>
              <div class="small text-muted mb-2">Thomas & Eleanor Vance</div>
              <p class="small text-muted mb-3">Heirloom vine tomatoes, baby kale, organic herbs, and root crops.</p>
              <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                <span class="text-gold small fw-bold"><i class="bi bi-star-fill"></i> 4.9 (128 reviews)</span>
                <a href="{{ url('/farmer-profile') }}?id=f1" class="btn btn-sm btn-forest rounded-pill px-3">View Stall</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="farmer-card">
            <div class="card-image-wrap">
              <span class="card-badge-top">Stall #08</span>
              <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500&auto=format&fit=crop&q=80" class="card-img-top" alt="Meadow Gold">
            </div>
            <div class="card-body-custom">
              <h5 class="font-serif fs-6 mb-1">Meadow Gold Pastures</h5>
              <div class="small text-muted mb-2">Marcus Sterling</div>
              <p class="small text-muted mb-3">Pasture-raised eggs, goat milk cheese, grass-fed butter, and cream.</p>
              <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                <span class="text-gold small fw-bold"><i class="bi bi-star-fill"></i> 4.8 (162 reviews)</span>
                <a href="{{ url('/farmer-profile') }}?id=f3" class="btn btn-sm btn-forest rounded-pill px-3">View Stall</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="farmer-card">
            <div class="card-image-wrap">
              <span class="card-badge-top">Stall #12</span>
              <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?w=500&auto=format&fit=crop&q=80" class="card-img-top" alt="Wild Blossom">
            </div>
            <div class="card-body-custom">
              <h5 class="font-serif fs-6 mb-1">Wild Blossom Apiary & Orchard</h5>
              <div class="small text-muted mb-2">Sarah Jenkins</div>
              <p class="small text-muted mb-3">Raw wildflower honey, honeycomb cuts, and tree-ripened orchard apples.</p>
              <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                <span class="text-gold small fw-bold"><i class="bi bi-star-fill"></i> 5.0 (94 reviews)</span>
                <a href="{{ url('/farmer-profile') }}?id=f2" class="btn btn-sm btn-forest rounded-pill px-3">View Stall</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-white border-top border-subtle">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
          <span class="section-tag"><i class="bi bi-basket"></i> Pre-Order for Pickup</span>
          <h3 class="font-serif">Produce Available for Weekend Pickup</h3>
        </div>
        <a href="{{ url('/products') }}" class="btn btn-forest rounded-pill px-3">Explore All Produce</a>
      </div>

      <div class="row g-4">
        
        <div class="col-sm-6 col-lg-3">
          <div class="product-card">
            <div class="card-image-wrap">
              <span class="card-badge-top stock-in"><i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> In Stock</span>
              <img src="https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=500&auto=format&fit=crop&q=80" alt="Heirloom Tomatoes" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <span class="text-muted small text-uppercase fw-bold">Vegetables</span>
              <h5 class="card-title font-serif fs-6 mb-1"><a href="{{ url('/product-details') }}?id=p1" class="text-forest text-decoration-none">Vine-Ripened Heirloom Tomatoes</a></h5>
              <p class="text-muted small mb-2">Vance Heritage Farm</p>
              <div class="d-flex align-items-baseline justify-content-between mt-auto pt-2 border-top">
                <div><span class="product-price">$4.50</span><span class="product-unit">/lb</span></div>
                <button class="btn btn-sm btn-forest rounded-pill px-3" onclick="addToCartClicked('p1', 'Vine-Ripened Heirloom Tomatoes', 4.50, 'lb', 'Vance Heritage Farm', 'Valley Green Community Market', 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=500&auto=format&fit=crop&q=80')">Add</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="product-card">
            <div class="card-image-wrap">
              <span class="card-badge-top stock-in"><i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> In Stock</span>
              <img src="https://images.unsplash.com/photo-1524179091875-bf99a9a6af57?w=500&auto=format&fit=crop&q=80" alt="Kale" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <span class="text-muted small text-uppercase fw-bold">Vegetables</span>
              <h5 class="card-title font-serif fs-6 mb-1"><a href="{{ url('/product-details') }}?id=p6" class="text-forest text-decoration-none">Tender Baby Curly Kale</a></h5>
              <p class="text-muted small mb-2">Vance Heritage Farm</p>
              <div class="d-flex align-items-baseline justify-content-between mt-auto pt-2 border-top">
                <div><span class="product-price">$2.75</span><span class="product-unit">/bunch</span></div>
                <button class="btn btn-sm btn-forest rounded-pill px-3" onclick="addToCartClicked('p6', 'Tender Baby Curly Kale Bunch', 2.75, 'bunch', 'Vance Heritage Farm', 'Valley Green Community Market', 'https://images.unsplash.com/photo-1524179091875-bf99a9a6af57?w=500&auto=format&fit=crop&q=80')">Add</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="product-card">
            <div class="card-image-wrap">
              <span class="card-badge-top stock-low"><i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> Low Stock</span>
              <img src="https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=500&auto=format&fit=crop&q=80" alt="Pasture-Raised Eggs" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <span class="text-muted small text-uppercase fw-bold">Eggs</span>
              <h5 class="card-title font-serif fs-6 mb-1"><a href="{{ url('/product-details') }}?id=p3" class="text-forest text-decoration-none">Pasture-Raised Eggs</a></h5>
              <p class="text-muted small mb-2">Meadow Gold Pastures</p>
              <div class="d-flex align-items-baseline justify-content-between mt-auto pt-2 border-top">
                <div><span class="product-price">$6.25</span><span class="product-unit">/dozen</span></div>
                <button class="btn btn-sm btn-forest rounded-pill px-3" onclick="addToCartClicked('p3', 'Pasture-Raised Golden Yolk Eggs', 6.25, 'dozen', 'Meadow Gold Pastures', 'Valley Green Community Market', 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=500&auto=format&fit=crop&q=80')">Add</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="product-card">
            <div class="card-image-wrap">
              <span class="card-badge-top stock-in"><i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> In Stock</span>
              <img src="https://images.unsplash.com/photo-1618164435735-413d3b066c9a?w=500&auto=format&fit=crop&q=80" alt="Sweet Basil" class="card-img-top">
            </div>
            <div class="card-body-custom">
              <span class="text-muted small text-uppercase fw-bold">Herbs</span>
              <h5 class="card-title font-serif fs-6 mb-1"><a href="{{ url('/product-details') }}?id=p8" class="text-forest text-decoration-none">Fresh Sweet Basil</a></h5>
              <p class="text-muted small mb-2">Vance Heritage Farm</p>
              <div class="d-flex align-items-baseline justify-content-between mt-auto pt-2 border-top">
                <div><span class="product-price">$3.20</span><span class="product-unit">/bunch</span></div>
                <button class="btn btn-sm btn-forest rounded-pill px-3" onclick="addToCartClicked('p8', 'Fresh Organic Sweet Basil Bunch', 3.20, 'bunch', 'Vance Heritage Farm', 'Valley Green Community Market', 'https://images.unsplash.com/photo-1618164435735-413d3b066c9a?w=500&auto=format&fit=crop&q=80')">Add</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="marketlink-footer py-4">
    <div class="container text-center">
      <p class="mb-1 text-white-50">&copy; 2026 MarketLink – Connecting local farmers with local communities.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/cart.js') }}"></script>
  <script src="{{ asset('assets/js/ai-assistant.js') }}"></script>
</body>
</html>
