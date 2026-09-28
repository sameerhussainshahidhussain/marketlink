@extends('layouts.app')

@section('title', 'MarketLink – eGreen Basket | Local Farmers Market Platform')
@section('meta_description', 'Discover fresh seasonal produce, explore local weekend farmers markets, and reserve fresh harvest for easy pickup at community stalls.')

@section('content')

  <section class="hero-fullscreen">
    <div class="container hero-content position-relative text-center text-white">
      <div class="hero-eyebrow-badge mx-auto mb-4">
        <span class="pulse-dot"></span>
        <span>🌿 Fresh Harvest Every Weekend • Direct From Local Growers</span>
      </div>

      <h1 class="hero-title display-4 fw-bold mb-3">
        Fresh Farm Produce,<br>
        <span class="text-mint-gradient">Straight From Local Growers.</span>
      </h1>

      <p class="hero-subtitle lead mx-auto mb-4">
        Find your neighborhood farmers market, reserve freshly harvested fruits, vegetables, and dairy, and pick up your order directly from the farmer's stall.
      </p>

      <div class="hero-glass-search mx-auto mb-4">
        <form action="{{ route('products.index') }}" method="GET" class="row g-2 align-items-center">
          <div class="col-md-5">
            <div class="input-group">
              <span class="input-group-text bg-transparent border-0 text-white-50 ps-3">
                <i class="bi bi-search fs-5"></i>
              </span>
              <input type="text" name="search" class="form-control hero-input" placeholder="Search spinach, tomatoes, raw honey...">
            </div>
          </div>
          <div class="col-md-4 border-start border-white border-opacity-25">
            <div class="input-group">
              <span class="input-group-text bg-transparent border-0 text-white-50 ps-2">
                <i class="bi bi-geo-alt fs-5"></i>
              </span>
              <select name="market" class="form-select hero-select">
                <option value="">All Weekend Markets</option>
                @foreach($allMarkets as $m)
                  <option value="{{ $m->id }}">{{ $m->market_name }} ({{ $m->city }})</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-hero-search w-100 py-3">
              <span>Find Produce</span>
              <i class="bi bi-arrow-right ms-1"></i>
            </button>
          </div>
        </form>
      </div>

      <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
        <a href="{{ url('/markets') }}" class="btn btn-hero-primary px-4 py-3">
          <i class="bi bi-shop-window me-2"></i> Browse All Markets
        </a>
        <a href="{{ url('/farmers') }}" class="btn btn-hero-outline px-4 py-3">
          <i class="bi bi-people me-2"></i> Meet Our Farmers
        </a>
      </div>

      <div class="row g-3 justify-content-center max-w-900 mx-auto">
        <div class="col-6 col-md-3">
          <div class="hero-stat-card">
            <div class="stat-number">{{ $stats['farmers'] ?? 4 }}+</div>
            <div class="stat-label">Verified Farmers</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="hero-stat-card">
            <div class="stat-number">{{ $stats['markets'] ?? 2 }}</div>
            <div class="stat-label">Active Markets</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="hero-stat-card">
            <div class="stat-number">{{ $stats['products'] ?? 10 }}+</div>
            <div class="stat-label">Fresh Produce Items</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="hero-stat-card">
            <div class="stat-number">{{ $stats['customers'] ?? 1 }}+</div>
            <div class="stat-label">Registered Shoppers</div>
          </div>
        </div>
      </div>

      <div class="hero-scroll-down mt-4">
        <a href="#trustSection" class="text-white-50 text-decoration-none small d-inline-flex flex-column align-items-center">
          <span>Scroll down</span>
          <i class="bi bi-chevron-double-down fs-5 mt-1 bounce-indicator"></i>
        </a>
      </div>
    </div>
  </section>

  <section id="trustSection" class="py-5 bg-white border-bottom border-subtle">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="trust-indicator-card">
            <div class="trust-icon-box">
              <i class="bi bi-flower2"></i>
            </div>
            <div>
              <h6 class="mb-1 fw-bold text-forest">Harvested Fresh</h6>
              <p class="small mb-0 text-muted">Picked freshly for market mornings, never stored in warehouses.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="trust-indicator-card">
            <div class="trust-icon-box">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <h6 class="mb-1 fw-bold text-forest">Community Markets</h6>
              <p class="small mb-0 text-muted">Find weekend markets in your area with exact stall coordinates.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="trust-indicator-card">
            <div class="trust-icon-box">
              <i class="bi bi-calendar2-check"></i>
            </div>
            <div>
              <h6 class="mb-1 fw-bold text-forest">Pay at Pickup</h6>
              <p class="small mb-0 text-muted">Reserve online for free and pay directly in person when collecting.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="trust-indicator-card">
            <div class="trust-icon-box">
              <i class="bi bi-heart-pulse-fill"></i>
            </div>
            <div>
              <h6 class="mb-1 fw-bold text-forest">Direct to Grower</h6>
              <p class="small mb-0 text-muted">100% of your payment goes straight to the grower with no cuts.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 my-3">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4">
        <div>
          <span class="section-tag"><i class="bi bi-geo"></i> Neighborhood Hubs</span>
          <h2 class="title-accent display-6">Weekend Farmers Markets</h2>
          <p class="text-muted mt-2 mb-0">Browse open-air markets operating this weekend across your city.</p>
        </div>
        <div class="mt-3 mt-md-0">
          <a href="{{ route('markets.index') }}" class="btn btn-outline-forest rounded-pill px-4">
            <span>View All Markets</span> <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <div class="row g-4">
        @forelse($featuredMarkets as $market)
          <div class="col-md-6 col-lg-4">
            <div class="market-card h-100 d-flex flex-column">
              <div class="card-image-wrap">
                <span class="card-badge-top"><i class="bi bi-calendar3"></i> {{ $market->operating_days }}</span>
                <span class="card-badge-distance"><i class="bi bi-geo-alt-fill text-gold"></i> {{ $market->city }}</span>
                <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=600&auto=format&fit=crop&q=80" alt="{{ $market->market_name }}" class="card-img-top">
              </div>
              <div class="card-body-custom flex-grow-1 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-1">
                  <span class="badge bg-sage text-forest small px-2 py-1 rounded-pill"><i class="bi bi-check-circle-fill text-emerald me-1"></i>Verified Market</span>
                </div>
                <h5 class="font-serif fs-5 mb-1"><a href="{{ route('markets.show', $market) }}" class="text-forest text-decoration-none">{{ $market->market_name }}</a></h5>
                <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-emerald"></i>{{ $market->address }}</p>
                <div class="d-flex align-items-center gap-3 py-2 my-2 border-top border-bottom border-subtle small">
                  <div><i class="bi bi-clock me-1 text-gold"></i>{{ date('h:i A', strtotime($market->opening_time)) }} - {{ date('h:i A', strtotime($market->closing_time)) }}</div>
                  <div class="ms-auto"><i class="bi bi-people me-1 text-forest"></i><strong>{{ $market->farmers()->count() }}</strong> Growers</div>
                </div>
                <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                  <span class="badge bg-sage text-forest px-3 py-2 rounded-pill">Open for Pre-Orders</span>
                  <a href="{{ route('markets.show', $market) }}" class="btn btn-sm btn-forest rounded-pill px-3">
                    <span>Explore Stalls</span> <i class="bi bi-arrow-right ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 py-4 text-center text-muted">No markets featured yet.</div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="py-5 bg-cream">
    <div class="container">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="section-tag"><i class="bi bi-grid"></i> Categories</span>
        <h2 class="title-accent display-6">Shop by Category</h2>
        <p class="text-muted mt-2">Find seasonal produce, farm-fresh dairy, pure honey, and fresh culinary herbs.</p>
      </div>

      <div class="row g-3 row-cols-2 row-cols-md-4">
        @php
          $catIcons = [
            'vegetables' => 'bi-flower2',
            'fruits' => 'bi-apple',
            'dairy' => 'bi-cup-straw',
            'dairy-eggs' => 'bi-egg',
            'baked' => 'bi-cake2',
            'bakery' => 'bi-cake2',
            'herbs' => 'bi-tree',
            'eggs' => 'bi-egg',
            'honey' => 'bi-droplet-half',
            'preserves' => 'bi-box-seam',
            'pantry' => 'bi-box-seam',
          ];
        @endphp
        @forelse($categories as $category)
          @php
            $slugKey = Str::slug($category->slug);
            $icon = $catIcons[$slugKey] ?? 'bi-basket2';
          @endphp
          <div class="col">
            <a href="{{ route('products.index', ['category' => $category->id]) }}" class="category-card">
              <div class="category-icon-wrapper"><i class="bi {{ $icon }}"></i></div>
              <h6 class="category-title">{{ $category->name }}</h6>
              <span class="category-count">{{ $category->products_count }} {{ Str::plural('Item', $category->products_count) }}</span>
            </a>
          </div>
        @empty
          <div class="col-12 text-center py-4 text-muted">No categories available at the moment.</div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="py-5 my-3">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4">
        <div>
          <span class="section-tag"><i class="bi bi-people"></i> Local Growers</span>
          <h2 class="title-accent display-6">Meet the Farmers</h2>
          <p class="text-muted mt-2 mb-0">Learn about our local family farms, their crops, and weekend stalls.</p>
        </div>
        <div class="mt-3 mt-md-0">
          <a href="{{ route('farmers.index') }}" class="btn btn-outline-forest rounded-pill px-4">
            <span>View All Farmers</span> <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <div class="row g-4">
        @forelse($featuredFarmers as $farmer)
          <div class="col-md-6 col-lg-3">
            <div class="farmer-card-elevated h-100 d-flex flex-column">
              <div class="farmer-banner" style="background-image: url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=500&auto=format&fit=crop&q=80');"></div>
              <div class="farmer-avatar-wrap">
                <img src="{{ $farmer->profile_image ? asset('storage/' . $farmer->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=200&auto=format&fit=crop&q=80' }}" alt="{{ $farmer->name }}" class="farmer-avatar-img object-fit-cover">
                <span class="farmer-badge-check" title="Verified Local Farmer"><i class="bi bi-check-lg"></i></span>
              </div>
              <div class="p-3 text-center d-flex flex-column flex-grow-1">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-1">
                  <span class="badge bg-sage text-forest small">Verified Grower</span>
                </div>
                <h5 class="font-serif fs-6 mb-1"><a href="{{ route('farmers.show', $farmer) }}" class="text-forest text-decoration-none">{{ $farmer->farmerProfile->business_name ?? $farmer->name }}</a></h5>
                <div class="small text-muted mb-2">{{ $farmer->name }}</div>
                <p class="small text-muted mb-3"><i class="bi bi-geo-alt me-1 text-emerald"></i>{{ $farmer->farmerProfile->location_name ?? 'Local Farm' }}</p>
                <div class="mt-auto pt-2 border-top">
                  <a href="{{ route('farmers.show', $farmer) }}" class="btn btn-sm btn-outline-forest w-100 rounded-pill">View Stall & Stock</a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 py-4 text-center text-muted">No farmers listed yet.</div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="py-5 bg-white border-top border-bottom border-subtle">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4">
        <div>
          <span class="section-tag"><i class="bi bi-basket"></i> Weekly Stock</span>
          <h2 class="title-accent display-6">Available Produce This Weekend</h2>
          <p class="text-muted mt-2 mb-0">Pre-order before cutoff times so the farmer can harvest your items.</p>
        </div>
        <div class="mt-3 mt-md-0">
          <a href="{{ url('/products') }}" class="btn btn-forest rounded-pill px-4">
            <span>Browse Full Catalog</span> <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <div class="row g-4">
        @forelse($featuredProducts as $prod)
          <div class="col-sm-6 col-lg-3">
            <div class="product-card-elevated h-100 d-flex flex-column">
              <div class="card-image-wrap">
                @if($prod->stock_quantity > 5)
                  <span class="card-badge-top stock-in"><i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> In Stock ({{ $prod->stock_quantity }})</span>
                @elseif($prod->stock_quantity > 0)
                  <span class="card-badge-top stock-low"><i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> Low Stock ({{ $prod->stock_quantity }})</span>
                @else
                  <span class="card-badge-top stock-out bg-danger text-white"><i class="bi bi-x-circle" style="font-size:0.55rem;"></i> Sold Out</span>
                @endif

                @auth
                  @if(auth()->user()->isCustomer())
                    <form method="POST" action="{{ route('customer.favorites.product', $prod) }}" class="d-inline">
                      @csrf
                      <button type="submit" class="favorite-btn {{ auth()->user()->favoriteProducts()->where('product_id', $prod->id)->exists() ? 'active' : '' }}" aria-label="Favorite">
                        <i class="bi {{ auth()->user()->favoriteProducts()->where('product_id', $prod->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                      </button>
                    </form>
                  @endif
                @endauth

                <a href="{{ route('products.show', $prod) }}">
                  <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="card-img-top object-fit-cover" style="height: 180px;">
                </a>
              </div>
              <div class="card-body-custom flex-grow-1 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-1">
                  <span class="text-muted small text-uppercase fw-bold">{{ $prod->category->name ?? 'Fresh Produce' }}</span>
                  <span class="text-gold small fw-bold">
                    <i class="bi bi-star-fill"></i> {{ number_format($prod->reviews()->avg('rating') ?: 5.0, 1) }}
                  </span>
                </div>
                <h5 class="card-title font-serif fs-6 mb-1">
                  <a href="{{ route('products.show', $prod) }}" class="text-forest text-decoration-none">{{ $prod->name }}</a>
                </h5>
                <p class="text-muted small mb-2"><i class="bi bi-shop me-1 text-emerald"></i>{{ $prod->farmer->farmerProfile->business_name ?? $prod->farmer->name }}</p>
                <div class="d-flex align-items-baseline justify-content-between mt-auto pt-2 border-top">
                  <div>
                    <span class="product-price">Rs. {{ number_format($prod->price, 2) }}</span>
                    <span class="product-unit">/{{ $prod->unit }}</span>
                  </div>
                  @auth
                    @if(auth()->user()->isCustomer())
                      @if($prod->stock_quantity > 0)
                        <form method="POST" action="{{ route('customer.cart.add') }}" class="d-inline">
                          @csrf
                          <input type="hidden" name="product_id" value="{{ $prod->id }}">
                          <input type="hidden" name="quantity" value="1">
                          <button type="submit" class="btn btn-sm btn-forest rounded-pill px-3" title="Add to Basket">
                            <i class="bi bi-basket me-1"></i> Add
                          </button>
                        </form>
                      @else
                        <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>Sold Out</button>
                      @endif
                    @else
                      <a href="{{ route('products.show', $prod) }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
                        View
                      </a>
                    @endif
                  @else
                    <a href="{{ route('products.show', $prod) }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
                      View
                    </a>
                  @endauth
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 py-4 text-center text-muted">No fresh produce listed yet today. Check back soon!</div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="py-5 my-4">
    <div class="container">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="section-tag"><i class="bi bi-lightning-charge"></i> How It Works</span>
        <h2 class="title-accent display-6">Simple 4-Step Process</h2>
        <p class="text-muted mt-2">No online cards or hidden fees. Reserve what you need and collect directly from the stall.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="step-card-elevated">
            <span class="step-watermark-number">01</span>
            <div class="step-icon-container"><i class="bi bi-compass"></i></div>
            <h5 class="font-serif fs-5 mb-2">1. Find a Market</h5>
            <p class="text-muted small mb-0">Look up weekend farmers markets in your city, check operating timings, and see attending growers.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="step-card-elevated">
            <span class="step-watermark-number">02</span>
            <div class="step-icon-container"><i class="bi bi-basket2"></i></div>
            <h5 class="font-serif fs-5 mb-2">2. Choose Produce</h5>
            <p class="text-muted small mb-0">Add seasonal vegetables, fresh fruit, raw honey, and farm dairy directly to your basket.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="step-card-elevated">
            <span class="step-watermark-number">03</span>
            <div class="step-icon-container"><i class="bi bi-calendar-check"></i></div>
            <h5 class="font-serif fs-5 mb-2">3. Pick a Time Slot</h5>
            <p class="text-muted small mb-0">Choose your pickup day and time window before the farmer's order cutoff deadline.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="step-card-elevated">
            <span class="step-watermark-number">04</span>
            <div class="step-icon-container"><i class="bi bi-bag-heart"></i></div>
            <h5 class="font-serif fs-5 mb-2">4. Collect & Pay</h5>
            <p class="text-muted small mb-0">Visit the stall on market day, check your fresh harvest box, and pay the farmer in person.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-cream">
    <div class="container">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="section-tag"><i class="bi bi-chat-heart"></i> Customer Feedback</span>
        <h2 class="title-accent display-6">What Shoppers Are Saying</h2>
        <p class="text-muted mt-2">Real reviews from people who pick up their weekly groceries through MarketLink.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="review-card-elevated">
            <div class="text-gold mb-3">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="text-muted mb-4 fst-italic">
              "We love picking up our weekly greens from Ahmed Ali's stall in Gulberg. Reserving on Friday means our box is already packed and fresh when we arrive Saturday morning."
            </p>
            <div class="mt-auto d-flex align-items-center gap-3">
              <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Amina Tariq" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;">
              <div>
                <h6 class="mb-0 fw-bold text-forest">Amina Tariq</h6>
                <span class="small text-muted">Weekly Shopper • Lahore</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-card-elevated">
            <div class="text-gold mb-3">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="text-muted mb-4 fst-italic">
              "Finding pure unpasteurized buffalo milk and fresh strawberries used to be hard. With MarketLink, Fatima has our order ready at DHA Phase 6 without any delays."
            </p>
            <div class="mt-auto d-flex align-items-center gap-3">
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="Bilal Siddiqui" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;">
              <div>
                <h6 class="mb-0 fw-bold text-forest">Bilal Siddiqui</h6>
                <span class="small text-muted">Regular Shopper • Karachi</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="review-card-elevated">
            <div class="text-gold mb-3">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="text-muted mb-4 fst-italic">
              "The pickup system is so straightforward. No credit card details needed online. We just show our order number at Hassan's honey stall, inspect the jars, and pay in cash."
            </p>
            <div class="mt-auto d-flex align-items-center gap-3">
              <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format&fit=crop&q=80" alt="Zainab Malik" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;">
              <div>
                <h6 class="mb-0 fw-bold text-forest">Zainab Malik</h6>
                <span class="small text-muted">Market Visitor • Islamabad</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-forest text-white">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <span class="badge bg-gold-subtle text-dark px-3 py-2 rounded-pill fw-bold mb-3">
            <i class="bi bi-map-fill text-gold me-1"></i> Interactive Map
          </span>
          <h2 class="display-6 font-serif text-white mb-3">Find Weekend Markets Near You</h2>
          <p class="text-white-50 fs-6 mb-4" style="max-width: 580px;">
            Check market locations, operating days, opening hours, and attending growers. Get directions straight to the venue.
          </p>
          <div class="d-flex flex-wrap gap-3">
            <a href="{{ url('/map') }}" class="btn btn-gold rounded-pill px-4 py-2">
              <i class="bi bi-geo-alt me-1"></i> Open Market Map
            </a>
            <a href="{{ url('/markets') }}" class="btn btn-outline-light rounded-pill px-4 py-2">
              Browse Markets List
            </a>
          </div>
        </div>
        <div class="col-lg-5 text-center">
          <div class="p-3 bg-white bg-opacity-10 rounded-24 border border-white border-opacity-25 shadow-lg">
            <img src="https://images.unsplash.com/photo-1524813686514-a57563d77d66?w=600&auto=format&fit=crop&q=80" alt="Market Locator Preview" class="img-fluid rounded-16 shadow">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-white border-top border-subtle">
    <div class="container">
      <div class="p-5 rounded-32 bg-sage text-center text-lg-start d-flex flex-column flex-lg-row align-items-center justify-content-between gap-4">
        <div>
          <span class="badge bg-forest text-white px-3 py-2 rounded-pill mb-2">🌿 For Local Growers</span>
          <h3 class="display-6 font-serif text-forest mb-2">Grow Local Produce or Run a Market Stall?</h3>
          <p class="text-muted mb-0" style="max-width: 580px;">
            Register your stall on MarketLink, list your weekly harvest availability, and receive confirmed pre-orders from families before market morning.
          </p>
        </div>
        <div class="d-flex flex-wrap gap-3 flex-shrink-0">
          <a href="{{ route('register.farmer') }}" class="btn btn-forest rounded-pill px-4 py-3">
            <span>Apply as Grower</span> <i class="bi bi-arrow-right ms-1"></i>
          </a>
          <a href="{{ route('login') }}" class="btn btn-outline-forest rounded-pill px-4 py-3">
            <span>Farmer Portal</span>
          </a>
        </div>
      </div>
    </div>
  </section>

@endsection
