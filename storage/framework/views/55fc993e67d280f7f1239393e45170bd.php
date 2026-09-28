<?php $__env->startSection('title', 'Browse Farm Fresh Produce | MarketLink'); ?>

<?php $__env->startSection('content'); ?>
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <span class="section-tag"><i class="bi bi-basket"></i> Farm-to-Table Marketplace</span>
          <h1 class="display-6 font-serif">Harvest-Fresh Seasonal Organic Produce</h1>
          <p class="text-muted mb-0">Reserve crisp vegetables, orchard fruits, free-range eggs, and raw honey directly from local producers.</p>
        </div>
        <div class="col-lg-5">
          <form method="GET" action="<?php echo e(route('products.index')); ?>" class="card p-3 rounded-24 border-subtle shadow-sm bg-white">
            <div class="input-group">
              <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
              <input type="text" name="search" class="form-control border-0 shadow-none" value="<?php echo e(request('search')); ?>" placeholder="Search products, vegetables, fruits...">
              <button class="btn btn-forest rounded-pill px-4">Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      
      <div class="d-flex gap-2 overflow-auto pb-3 mb-4">
        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-sm <?php echo e(!request('category') ? 'btn-forest' : 'btn-outline-forest'); ?> rounded-pill text-nowrap">All Harvests</a>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('products.index', ['category' => $cat->id])); ?>" class="btn btn-sm <?php echo e(request('category') == $cat->id ? 'btn-forest' : 'btn-outline-forest'); ?> rounded-pill text-nowrap"><?php echo e($cat->name); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card p-3 rounded-24 border-subtle shadow-xs bg-white h-100 d-flex flex-column">
              <div class="position-relative mb-2">
                <img src="<?php echo e($product->image_url); ?>" class="rounded-16 w-100 object-fit-cover" height="170" alt="<?php echo e($product->name); ?>">
                <span class="badge bg-forest position-absolute top-0 end-0 m-2 rounded-pill shadow-xs">Rs. <?php echo e($product->price); ?> / <?php echo e($product->unit); ?></span>
              </div>
              <span class="badge bg-sage text-forest rounded-pill align-self-start mb-1 px-2 py-1 small"><?php echo e($product->category->name ?? 'Produce'); ?></span>
              <h6 class="font-serif fs-6 mb-1"><a href="<?php echo e(route('products.show', $product)); ?>" class="text-forest text-decoration-none"><?php echo e($product->name); ?></a></h6>
              <p class="small text-muted mb-2"><i class="bi bi-shop me-1 text-emerald"></i><?php echo e($product->farmer->farmerProfile->business_name ?? $product->farmer->name); ?></p>
              
              <div class="mt-auto pt-2 d-flex gap-2">
                <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-sm btn-outline-forest flex-fill rounded-pill">Details</a>
                <?php if(auth()->guard()->check()): ?>
                  <?php if(auth()->user()->isCustomer()): ?>
                    <form method="POST" action="<?php echo e(route('customer.cart.add')); ?>" class="d-inline">
                      <?php echo csrf_field(); ?>
                      <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                      <input type="hidden" name="quantity" value="1">
                      <button type="submit" class="btn btn-sm btn-forest rounded-pill px-3" title="Add 1 to Cart"><i class="bi bi-cart-plus"></i></button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-12 text-center py-5">
            <i class="bi bi-basket text-muted fs-1 mb-3 d-block"></i>
            <h5 class="font-serif text-muted">No products found matching your search</h5>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-forest rounded-pill mt-3">Reset Filters</a>
          </div>
        <?php endif; ?>
      </div>

      <div class="mt-5 d-flex justify-content-center">
        <?php echo e($products->links()); ?>

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/products/index.blade.php ENDPATH**/ ?>