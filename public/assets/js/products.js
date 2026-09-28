/**
 * MarketLink - Products & Catalog Data Engine
 * Supplies realistic organic produce data and search/filter functionality
 */

const MarketLinkData = {
  categories: [
    { id: 'vegetables', name: 'Vegetables', icon: 'bi-flower2', count: 48, img: 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=300&auto=format&fit=crop&q=80' },
    { id: 'fruits', name: 'Fruits', icon: 'bi-apple', count: 34, img: 'https://images.unsplash.com/photo-1619566636858-adf3ef46400b?w=300&auto=format&fit=crop&q=80' },
    { id: 'dairy', name: 'Dairy & Cheese', icon: 'bi-cup-straw', count: 18, img: 'https://images.unsplash.com/photo-1528750997573-59b89d56f4f7?w=300&auto=format&fit=crop&q=80' },
    { id: 'baked', name: 'Baked Goods', icon: 'bi-cake2', count: 22, img: 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=300&auto=format&fit=crop&q=80' },
    { id: 'herbs', name: 'Herbs & Microgreens', icon: 'bi-tree', count: 16, img: 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=300&auto=format&fit=crop&q=80' },
    { id: 'eggs', name: 'Farm Fresh Eggs', icon: 'bi-egg', count: 12, img: 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=300&auto=format&fit=crop&q=80' },
    { id: 'honey', name: 'Raw Honey & Jams', icon: 'bi-droplet-half', count: 15, img: 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=300&auto=format&fit=crop&q=80' },
    { id: 'other', name: 'Pantry & Preserves', icon: 'bi-box-seam', count: 20, img: 'https://images.unsplash.com/photo-1506084868230-bb9d95c24759?w=300&auto=format&fit=crop&q=80' }
  ],

  markets: [
    {
      id: 'm1',
      name: 'Valley Green Community Market',
      location: '142 Orchard Way, Green Valley',
      day: 'Saturday & Sunday',
      time: '08:00 AM - 02:00 PM',
      farmersCount: 24,
      productsCount: 140,
      distance: '1.8 miles',
      image: 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=600&auto=format&fit=crop&q=80',
      description: 'A vibrant weekend gathering of independent growers offering certified heirloom vegetables, pasture-raised eggs, and wood-fired artisanal bread.'
    },
    {
      id: 'm2',
      name: 'Riverfront Organic Farmers Bazaar',
      location: '88 Waterfront Esplanade, Riverside',
      day: 'Wednesday & Saturday',
      time: '07:30 AM - 01:00 PM',
      farmersCount: 32,
      productsCount: 195,
      distance: '3.4 miles',
      image: 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?w=600&auto=format&fit=crop&q=80',
      description: 'Scenic open-air riverside market showcasing orchard fresh fruits, raw wild blossom honey, grass-fed dairy, and wild mushrooms.'
    },
    {
      id: 'm3',
      name: 'Highland Heritage Producers Fair',
      location: '500 Hilltop Ridge Rd, Highland Peak',
      day: 'Sunday Morning',
      time: '09:00 AM - 03:00 PM',
      farmersCount: 18,
      productsCount: 98,
      distance: '5.2 miles',
      image: 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=600&auto=format&fit=crop&q=80',
      description: 'Mountain-valley growers celebrated for pesticide-free heirloom squashes, hand-churned goat cheese, and cold-pressed cider.'
    },
    {
      id: 'm4',
      name: 'Sunnybrook Artisan Market',
      location: '210 Meadowlane Plaza, Sunnybrook',
      day: 'Friday Afternoon',
      time: '02:00 PM - 07:00 PM',
      farmersCount: 28,
      productsCount: 165,
      distance: '6.0 miles',
      image: 'https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=600&auto=format&fit=crop&q=80',
      description: 'Perfect for pre-weekend pickups with freshly harvested greens, berries, sour dough loaves, and cut flowers.'
    }
  ],

  farmers: [
    {
      id: 'f1',
      name: 'Thomas & Eleanor Vance',
      stallName: 'Vance Heritage Organic Farm',
      market: 'Valley Green Community Market',
      location: 'Green Valley, Sector 4',
      categories: ['Vegetables', 'Herbs'],
      rating: 4.9,
      reviewsCount: 128,
      image: 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=500&auto=format&fit=crop&q=80',
      bio: 'Cultivating non-GMO heirloom crops with regenerative compost and zero synthetic sprays for over 22 years.'
    },
    {
      id: 'f2',
      name: 'Sarah Jenkins',
      stallName: 'Wild Blossom Apiary & Orchard',
      market: 'Riverfront Organic Farmers Bazaar',
      location: 'Riverbed Acres, Stall 12',
      categories: ['Fruits', 'Honey'],
      rating: 5.0,
      reviewsCount: 94,
      image: 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=500&auto=format&fit=crop&q=80',
      bio: 'Certified ethical beekeeping and cold-extracted raw wildflower honey with crisp tree-ripened heritage apples.'
    },
    {
      id: 'f3',
      name: 'Marcus Sterling',
      stallName: 'Meadow Gold Pastures',
      market: 'Highland Heritage Producers Fair',
      location: 'Highland Ridge',
      categories: ['Dairy', 'Eggs'],
      rating: 4.8,
      reviewsCount: 162,
      image: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500&auto=format&fit=crop&q=80',
      bio: 'Grass-fed A2 raw milk, pasture-roaming hen eggs, and small batch aged alpine cheeses crafted every morning.'
    },
    {
      id: 'f4',
      name: 'Clara Dubois',
      stallName: 'L’Artisan Sourdough Oven',
      market: 'Sunnybrook Artisan Market',
      location: 'Sunnybrook Plaza, Stall 05',
      categories: ['Baked Goods'],
      rating: 4.9,
      reviewsCount: 88,
      image: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop&q=80',
      bio: 'Natural wild sourdough breads, rye loaves, and stone-ground rustic baguettes fermented for 36 hours.'
    }
  ],

  products: [
    {
      id: 'p1',
      name: 'Vine-Ripened Heirloom Tomatoes',
      category: 'vegetables',
      farmer: 'Vance Heritage Organic Farm',
      farmerId: 'f1',
      market: 'Valley Green Community Market',
      price: 4.50,
      unit: 'lb',
      stock: 'In Stock',
      stockClass: 'stock-in',
      qtyAvailable: 35,
      rating: 4.9,
      reviews: 42,
      image: 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=500&auto=format&fit=crop&q=80',
      description: 'Sweet, juicy, multi-colored heirloom varieties harvested just hours prior to market pickup. Rich in natural flavor.'
    },
    {
      id: 'p2',
      name: 'Crisp Organic Honeycrisp Apples',
      category: 'fruits',
      farmer: 'Wild Blossom Apiary & Orchard',
      farmerId: 'f2',
      market: 'Riverfront Organic Farmers Bazaar',
      price: 3.80,
      unit: 'lb',
      stock: 'In Stock',
      stockClass: 'stock-in',
      qtyAvailable: 50,
      rating: 5.0,
      reviews: 38,
      image: 'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=500&auto=format&fit=crop&q=80',
      description: 'Hand-picked from pesticide-free trees, known for distinct snap and perfectly balanced tart sweetness.'
    },
    {
      id: 'p3',
      name: 'Pasture-Raised Golden Yolk Eggs',
      category: 'eggs',
      farmer: 'Meadow Gold Pastures',
      farmerId: 'f3',
      market: 'Highland Heritage Producers Fair',
      price: 6.25,
      unit: 'dozen',
      stock: 'Low Stock',
      stockClass: 'stock-low',
      qtyAvailable: 6,
      rating: 4.9,
      reviews: 56,
      image: 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=500&auto=format&fit=crop&q=80',
      description: 'Laid by outdoor free-roaming hens with nutrient-rich diets. Deep orange yolks and robust shells.'
    },
    {
      id: 'p4',
      name: 'Raw Mountain Wildflower Honey',
      category: 'honey',
      farmer: 'Wild Blossom Apiary & Orchard',
      farmerId: 'f2',
      market: 'Riverfront Organic Farmers Bazaar',
      price: 11.50,
      unit: '16oz jar',
      stock: 'In Stock',
      stockClass: 'stock-in',
      qtyAvailable: 24,
      rating: 5.0,
      reviews: 29,
      image: 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=500&auto=format&fit=crop&q=80',
      description: 'Unfiltered, unpasteurized raw honey brimming with native pollen, enzymes, and delicate floral aromatics.'
    },
    {
      id: 'p5',
      name: 'Artisan Country Sourdough Batard',
      category: 'baked',
      farmer: 'L’Artisan Sourdough Oven',
      farmerId: 'f4',
      market: 'Sunnybrook Artisan Market',
      price: 7.00,
      unit: 'loaf',
      stock: 'Low Stock',
      stockClass: 'stock-low',
      qtyAvailable: 4,
      rating: 4.8,
      reviews: 31,
      image: 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=500&auto=format&fit=crop&q=80',
      description: 'Naturally leavened using traditional slow fermentation. Crackling blistered crust with open airy crumb.'
    },
    {
      id: 'p6',
      name: 'Tender Baby Curly Kale Bunch',
      category: 'vegetables',
      farmer: 'Vance Heritage Organic Farm',
      farmerId: 'f1',
      market: 'Valley Green Community Market',
      price: 2.75,
      unit: 'bunch',
      stock: 'In Stock',
      stockClass: 'stock-in',
      qtyAvailable: 40,
      rating: 4.7,
      reviews: 19,
      image: 'https://images.unsplash.com/photo-1524179091875-bf99a9a6af57?w=500&auto=format&fit=crop&q=80',
      description: 'Dew-fresh curly organic kale leaves loaded with iron and vitamins. Great for crisp salads and morning juices.'
    },
    {
      id: 'p7',
      name: 'Aged Grass-Fed Farmhouse Cheddar',
      category: 'dairy',
      farmer: 'Meadow Gold Pastures',
      farmerId: 'f3',
      market: 'Highland Heritage Producers Fair',
      price: 8.90,
      unit: '250g block',
      stock: 'Sold Out',
      stockClass: 'stock-out',
      qtyAvailable: 0,
      rating: 4.9,
      reviews: 47,
      image: 'https://images.unsplash.com/photo-1528750997573-59b89d56f4f7?w=500&auto=format&fit=crop&q=80',
      description: 'Aged 14 months in natural caves. Sharp, buttery crystalline texture with a savory finish.'
    },
    {
      id: 'p8',
      name: 'Fresh Organic Sweet Basil Bunch',
      category: 'herbs',
      farmer: 'Vance Heritage Organic Farm',
      farmerId: 'f1',
      market: 'Valley Green Community Market',
      price: 3.20,
      unit: 'bunch',
      stock: 'In Stock',
      stockClass: 'stock-in',
      qtyAvailable: 28,
      rating: 4.8,
      reviews: 14,
      image: 'https://images.unsplash.com/photo-1618164435735-413d3b066c9a?w=500&auto=format&fit=crop&q=80',
      description: 'Aromatic Genovese sweet basil stems freshly snipped on market morning. Essential for fresh pesto.'
    }
  ]
};

// Render Product Card Component
function createProductCardHTML(product) {
  const isOutOfStock = product.stock === 'Sold Out';
  return `
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="product-card h-100">
        <div class="card-image-wrap">
          <span class="card-badge-top ${product.stockClass}">
            <i class="bi bi-circle-fill" style="font-size: 0.55rem;"></i> ${product.stock}
          </span>
          <button class="favorite-btn" data-id="${product.id}" data-name="${product.name}" data-type="product" aria-label="Save to Favorites">
            <i class="bi bi-heart"></i>
          </button>
          <img src="${product.image}" alt="${product.name}" class="card-img-top" loading="lazy">
        </div>
        <div class="card-body-custom">
          <div class="d-flex align-items-center justify-content-between mb-1">
            <span class="text-muted small text-uppercase fw-bold">${product.category}</span>
            <div class="d-flex align-items-center text-gold small">
              <i class="bi bi-star-fill me-1"></i> <span class="fw-bold text-dark">${product.rating}</span>
            </div>
          </div>
          <h5 class="card-title font-serif fs-6 mb-1">
            <a href="product-details.html?id=${product.id}" class="text-forest text-decoration-none">${product.name}</a>
          </h5>
          <p class="text-muted small mb-2"><i class="bi bi-shop me-1 text-emerald"></i>${product.farmer}</p>
          <div class="d-flex align-items-baseline justify-content-between mt-auto pt-2 border-top">
            <div>
              <span class="product-price">$${product.price.toFixed(2)}</span>
              <span class="product-unit">/${product.unit}</span>
            </div>
            ${isOutOfStock 
              ? `<button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>Sold Out</button>`
              : `<button class="btn btn-sm btn-forest rounded-pill px-3" onclick="addToCartClicked('${product.id}', '${product.name.replace(/'/g, "\\'")}', ${product.price}, '${product.unit}', '${product.farmer.replace(/'/g, "\\'")}', '${product.market.replace(/'/g, "\\'")}', '${product.image}')">
                  <i class="bi bi-basket me-1"></i> Add
                </button>`
            }
          </div>
        </div>
      </div>
    </div>
  `;
}

// Function to populate product lists with filters
function initProductsCatalog() {
  const container = document.getElementById('productsCatalogGrid');
  if (!container) return;

  const searchInput = document.getElementById('productSearchInput');
  const categoryFilter = document.getElementById('categoryFilterSelect');
  const sortSelect = document.getElementById('productSortSelect');
  const priceSlider = document.getElementById('priceRangeSlider');
  const priceDisplay = document.getElementById('priceRangeDisplay');
  const countBadge = document.getElementById('productResultsCount');

  let currentCategory = 'all';
  let searchQuery = '';
  let maxPrice = 50;
  let currentSort = 'featured';

  function filterAndRender() {
    let list = [...MarketLinkData.products];

    // Category filter
    if (currentCategory && currentCategory !== 'all') {
      list = list.filter(p => p.category.toLowerCase() === currentCategory.toLowerCase());
    }

    // Search query
    if (searchQuery.trim() !== '') {
      const q = searchQuery.toLowerCase();
      list = list.filter(p => 
        p.name.toLowerCase().includes(q) || 
        p.farmer.toLowerCase().includes(q) ||
        p.category.toLowerCase().includes(q)
      );
    }

    // Price
    list = list.filter(p => p.price <= maxPrice);

    // Sort
    if (currentSort === 'price-asc') {
      list.sort((a, b) => a.price - b.price);
    } else if (currentSort === 'price-desc') {
      list.sort((a, b) => b.price - a.price);
    } else if (currentSort === 'rating') {
      list.sort((a, b) => b.rating - a.rating);
    }

    if (countBadge) {
      countBadge.textContent = `${list.length} Products Found`;
    }

    if (list.length === 0) {
      container.innerHTML = `
        <div class="col-12">
          <div class="empty-state p-5">
            <div class="empty-icon"><i class="bi bi-search"></i></div>
            <h4 class="font-serif">No Products Found</h4>
            <p class="text-muted">Try adjusting your filters, searching for another keyword, or exploring other market categories.</p>
            <button class="btn btn-sage rounded-pill" onclick="resetFilters()">Reset All Filters</button>
          </div>
        </div>
      `;
      return;
    }

    container.innerHTML = list.map(createProductCardHTML).join('');
    if (typeof initFavoriteButtons === 'function') {
      initFavoriteButtons();
    }
  }

  window.resetFilters = function() {
    currentCategory = 'all';
    searchQuery = '';
    maxPrice = 50;
    currentSort = 'featured';
    if (searchInput) searchInput.value = '';
    if (categoryFilter) categoryFilter.value = 'all';
    if (sortSelect) sortSelect.value = 'featured';
    if (priceSlider) priceSlider.value = 50;
    if (priceDisplay) priceDisplay.textContent = '$50.00';
    document.querySelectorAll('.cat-pill-btn').forEach(b => b.classList.remove('active'));
    const allBtn = document.querySelector('.cat-pill-btn[data-category="all"]');
    if (allBtn) allBtn.classList.add('active');
    filterAndRender();
  };

  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      searchQuery = e.target.value;
      filterAndRender();
    });
  }

  if (categoryFilter) {
    categoryFilter.addEventListener('change', (e) => {
      currentCategory = e.target.value;
      filterAndRender();
    });
  }

  if (sortSelect) {
    sortSelect.addEventListener('change', (e) => {
      currentSort = e.target.value;
      filterAndRender();
    });
  }

  if (priceSlider && priceDisplay) {
    priceSlider.addEventListener('input', (e) => {
      maxPrice = parseFloat(e.target.value);
      priceDisplay.textContent = `$${maxPrice.toFixed(2)}`;
      filterAndRender();
    });
  }

  document.querySelectorAll('.cat-pill-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      document.querySelectorAll('.cat-pill-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentCategory = btn.getAttribute('data-category');
      filterAndRender();
    });
  });

  // Initial render
  filterAndRender();
}

document.addEventListener('DOMContentLoaded', () => {
  initProductsCatalog();
});
