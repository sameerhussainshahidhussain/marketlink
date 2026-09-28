<footer class="marketlink-footer">
    <div class="container">
      <div class="row g-4 justify-content-between">
        
        <div class="col-lg-4 col-md-6">
          <div class="d-inline-block bg-white p-2 px-3 rounded-16 mb-3 shadow-xs">
            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="MarketLink – Green Basket" height="42">
          </div>
          <p class="text-white-50 small mb-4" style="max-width: 320px;">
            Connecting families with local organic farmers across Lahore, Karachi, and Islamabad. Reserve fresh morning harvests during the week and collect them directly at your neighborhood weekend market stall.
          </p>
          <div class="d-flex gap-3">
            <a href="#" class="btn btn-sm btn-icon bg-white text-forest" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="btn btn-sm btn-icon bg-white text-forest" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="btn btn-sm btn-icon bg-white text-forest" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-6 col-6">
          <h6 class="footer-links-title">Discover</h6>
          <ul class="footer-links">
            <li><a href="<?php echo e(route('markets.index')); ?>">Browse Markets</a></li>
            <li><a href="<?php echo e(route('farmers.index')); ?>">Meet Farmers</a></li>
            <li><a href="<?php echo e(route('products.index')); ?>">Seasonal Produce</a></li>
            <li><a href="<?php echo e(route('map')); ?>">Interactive Map</a></li>
            <li><a href="<?php echo e(route('customer.favorites')); ?>">Saved Produce</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 col-6">
          <h6 class="footer-links-title">For Customers</h6>
          <ul class="footer-links">
            <li><a href="<?php echo e(route('customer.dashboard')); ?>">Customer Hub</a></li>
            <li><a href="<?php echo e(route('customer.orders')); ?>">My Pre-Orders</a></li>
            <li><a href="<?php echo e(route('customer.profile')); ?>">Account Profile</a></li>
            <li><a href="<?php echo e(route('customer.cart')); ?>">Shopping Basket</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 col-6">
          <h6 class="footer-links-title">For Producers</h6>
          <ul class="footer-links">
            <li><a href="<?php echo e(route('login')); ?>">Farmer Sign In</a></li>
            <li><a href="<?php echo e(route('register.farmer')); ?>">Become a Vendor</a></li>
            <li><a href="<?php echo e(route('farmer.dashboard')); ?>">Vendor Portal</a></li>
            <li><a href="<?php echo e(route('farmer.products.index')); ?>">Manage Products</a></li>
            <li><a href="<?php echo e(route('login')); ?>">Admin Console</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-6 col-6">
          <h6 class="footer-links-title">Company</h6>
          <ul class="footer-links">
            <li><a href="<?php echo e(url('/about')); ?>">Our Mission</a></li>
            <li><a href="<?php echo e(url('/contact')); ?>">Support & Inquiries</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
        <div>
          &copy; 2026 <strong>MarketLink</strong>. Built by Team Sameer for TechWiz 2026. Supporting local organic growers and community stalls.
        </div>
        <div class="d-flex align-items-center gap-3 small text-white-50">
          <span><i class="bi bi-shield-check text-gold me-1"></i> In-Person Pickup Guaranteed</span>
          <span><i class="bi bi-patch-check text-gold me-1"></i> Pay at Stall</span>
        </div>
      </div>
    </div>
  </footer><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/partials/footer.blade.php ENDPATH**/ ?>