<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pre-Order Basket | MarketLink – eGreen Basket</title>
  <meta name="description" content="Review your pre-order basket items for local farmers market pickup. Zero online payment required.">

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
          <li class="nav-item"><a class="nav-link" href="{{ url('/markets') }}">Markets</a></li>
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
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/markets') }}">Browse Markets</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/farmers') }}">Browse Farmers</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/products') }}">All Products</a></li>
        <li class="nav-item"><a class="nav-link fs-6" href="{{ url('/map') }}">Nearby Map</a></li>
      </ul>
      <div class="d-grid gap-2 pt-3 border-top">
        <a href="{{ url('/cart') }}" class="btn btn-sage active"><i class="bi bi-basket3 me-2"></i>My Basket</a>
        <a href="{{ url('/login') }}" class="btn btn-outline-forest">Sign In</a>
      </div>
    </div>
  </div>

  <section class="py-4 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Basket</li>
        </ol>
      </nav>
      <h1 class="display-6 font-serif mb-1">Your Pre-Order Basket</h1>
      <p class="text-muted small mb-0">Reserve fresh weekly harvests directly with growers. You pay at the market stall in person during pickup.</p>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        
        <div class="col-lg-8" id="cartItemsList">
          
        </div>

        <div class="col-lg-4" id="cartSummaryCard">
          <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white sticky-top" style="top: 100px;">
            <h5 class="font-serif mb-3">Pre-Order Summary</h5>
            
            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">Total Reserved Items</span>
              <strong id="cartItemCount">0 items</strong>
            </div>

            <div class="d-flex justify-content-between mb-3">
              <span class="text-muted">Estimated Total</span>
              <strong class="fs-5 text-forest" id="cartTotal">$0.00</strong>
            </div>

            <div class="p-3 bg-sage rounded-16 small mb-4">
              <div class="d-flex gap-2">
                <i class="bi bi-shield-check text-emerald fs-5"></i>
                <div>
                  <div class="fw-bold text-forest">Pay In Person at Pickup</div>
                  <div class="text-muted" style="font-size:0.8rem;">
                    As per MarketLink guidelines, no online card processing is charged. Your producer prepares your crate, and you pay upon collection.
                  </div>
                </div>
              </div>
            </div>

            <a href="{{ url('/checkout') }}" class="btn btn-forest rounded-pill py-3 w-100 text-center fw-bold">
              <span>Continue to Pickup Booking</span> <i class="bi bi-arrow-right ms-1"></i>
            </a>

            <div class="text-center mt-3">
              <a href="{{ url('/products') }}" class="text-forest text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i> Add More Produce
              </a>
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

  <script>
    // If cart is completely empty on fresh load, populate with a sample item for demonstration
    if (CartService.getCart().length === 0) {
      CartService.addItem({
        id: 'p1',
        name: 'Vine-Ripened Heirloom Tomatoes',
        price: 4.50,
        unit: 'lb',
        farmer: 'Vance Heritage Farm',
        market: 'Valley Green Community Market',
        image: 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=400&auto=format&fit=crop&q=80',
        qty: 2
      });
      CartService.addItem({
        id: 'p3',
        name: 'Pasture-Raised Golden Yolk Eggs',
        price: 6.25,
        unit: 'dozen',
        farmer: 'Meadow Gold Pastures',
        market: 'Highland Heritage Fair',
        image: 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=400&auto=format&fit=crop&q=80',
        qty: 1
      });
      CartService.renderCartPage();
    }
  </script>
</body>
</html>
