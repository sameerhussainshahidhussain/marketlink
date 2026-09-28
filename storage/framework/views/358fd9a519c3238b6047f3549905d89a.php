<?php $__env->startSection('title', 'Saved Favorites | MarketLink'); ?>
<?php $__env->startSection('page_title', 'Saved Favorites'); ?>
<?php $__env->startSection('page_subtitle', 'Your favorite local growers and fresh harvest items'); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('partials.customer-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('topbar_right'); ?>
  <a href="<?php echo e(route('products.index')); ?>" class="btn btn-sm btn-forest rounded-pill px-3">
    <i class="bi bi-search me-1"></i> Browse Marketplace
  </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
  <div class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <div>
        <h5 class="font-serif mb-1"><i class="bi bi-people text-forest me-2"></i>Favorite Growers & Farms</h5>
        <span class="text-muted small">Local producers you follow</span>
      </div>
      <span class="badge bg-sage text-forest rounded-pill px-3 py-2"><?php echo e($favoriteFarmers->count()); ?> Saved</span>
    </div>

    <div class="row g-4">
      <?php $__empty_1 = true; $__currentLoopData = $favoriteFarmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-xl-4">
          <div class="card p-3 rounded-20 border-subtle shadow-xs h-100 bg-white d-flex flex-column">
            <div class="d-flex align-items-center gap-3 mb-3">
              <img src="<?php echo e($farmer->profile_image ? asset('storage/' . $farmer->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=200&auto=format&fit=crop&q=80'); ?>" class="rounded-circle object-fit-cover" style="width:60px; height:60px;" alt="<?php echo e($farmer->name); ?>">
              <div class="overflow-hidden">
                <h6 class="mb-0 fs-6 text-truncate font-serif"><?php echo e($farmer->farmerProfile->business_name ?? $farmer->name); ?></h6>
                <span class="small text-muted d-block text-truncate"><?php echo e($farmer->farmerProfile->location_name ?? 'Local Farm'); ?></span>
                <div class="text-gold small"><i class="bi bi-star-fill"></i> 5.0 Verified Organic</div>
              </div>
            </div>
            <p class="small text-muted mb-3 flex-grow-1">
              <?php echo e(Str::limit($farmer->farmerProfile->bio ?? 'Dedicated organic farmer committed to sustainable practices.', 90)); ?>

            </p>
            <div class="mt-auto d-flex gap-2 pt-2 border-top">
              <a href="<?php echo e(route('farmers.show', $farmer)); ?>" class="btn btn-sm btn-forest rounded-pill flex-fill">View Stall & Stock</a>
              <form method="POST" action="<?php echo e(route('customer.favorites.farmer', $farmer)); ?>" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Remove from favorites"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
          <div class="card p-4 rounded-20 border-dashed text-center text-muted bg-white">
            <i class="bi bi-people fs-2 mb-2 text-muted d-block"></i>
            <p class="mb-2">You haven't favorited any farmers yet.</p>
            <a href="<?php echo e(route('farmers.index')); ?>" class="btn btn-sm btn-outline-forest rounded-pill px-4 align-self-center">Explore Farmers</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div>
    <div class="d-flex align-items-center justify-content-between mb-3">
      <div>
        <h5 class="font-serif mb-1"><i class="bi bi-basket text-forest me-2"></i>Favorite Produce & Goods</h5>
        <span class="text-muted small">Items saved for quick re-ordering</span>
      </div>
      <span class="badge bg-sage text-forest rounded-pill px-3 py-2"><?php echo e($favoriteProducts->count()); ?> Saved</span>
    </div>

    <div class="row g-4">
      <?php $__empty_1 = true; $__currentLoopData = $favoriteProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 col-xl-4">
          <div class="card p-3 rounded-20 border-subtle shadow-xs h-100 bg-white d-flex flex-column">
            <div class="d-flex align-items-center gap-3 mb-3">
              <img src="<?php echo e($product->image_url); ?>" class="rounded-12 object-fit-cover" style="width:60px; height:60px;" alt="<?php echo e($product->name); ?>">
              <div class="overflow-hidden">
                <h6 class="mb-0 fs-6 text-truncate font-serif">
                  <a href="<?php echo e(route('products.show', $product)); ?>" class="text-forest text-decoration-none"><?php echo e($product->name); ?></a>
                </h6>
                <span class="small text-muted fw-semibold">Rs. <?php echo e(number_format($product->price, 2)); ?> / <?php echo e($product->unit); ?></span>
                <div>
                  <?php if($product->stock_quantity > 0): ?>
                    <span class="badge bg-success-subtle text-success small py-0 px-2">In Stock (<?php echo e($product->stock_quantity); ?>)</span>
                  <?php else: ?>
                    <span class="badge bg-danger-subtle text-danger small py-0 px-2">Sold Out</span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <p class="small text-muted mb-3 flex-grow-1">
              <i class="bi bi-shop me-1 text-emerald"></i><?php echo e($product->farmer->farmerProfile->business_name ?? $product->farmer->name); ?>

            </p>
            <div class="mt-auto d-flex gap-2 pt-2 border-top">
              <?php if($product->stock_quantity > 0): ?>
                <form method="POST" action="<?php echo e(route('customer.cart.add')); ?>" class="d-inline flex-fill">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="btn btn-sm btn-forest rounded-pill w-100">Add to Basket</button>
                </form>
              <?php else: ?>
                <button class="btn btn-sm btn-secondary rounded-pill flex-fill" disabled>Sold Out</button>
              <?php endif; ?>
              <form method="POST" action="<?php echo e(route('customer.favorites.product', $product)); ?>" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Remove from favorites"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
          <div class="card p-4 rounded-20 border-dashed text-center text-muted bg-white">
            <i class="bi bi-basket fs-2 mb-2 text-muted d-block"></i>
            <p class="mb-2">You haven't saved any products yet.</p>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-sm btn-outline-forest rounded-pill px-4 align-self-center">Browse Produce</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/customer/favorites.blade.php ENDPATH**/ ?>