<?php $__env->startSection('title', $product->name . ' | MarketLink'); ?>

<?php $__env->startSection('content'); ?>
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Products</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
        </ol>
      </nav>

      <div class="row g-5">
        
        <div class="col-lg-6">
          <div class="card p-2 rounded-32 border-subtle shadow-sm bg-white overflow-hidden">
            <img src="<?php echo e($product->image_url); ?>" class="rounded-24 w-100 object-fit-cover" style="max-height: 420px;" alt="<?php echo e($product->name); ?>">
          </div>
        </div>

        <div class="col-lg-6">
          <span class="badge bg-forest text-white rounded-pill px-3 py-2 mb-2"><?php echo e($product->category->name ?? 'Organic Harvest'); ?></span>
          <h1 class="display-6 font-serif text-forest mb-2"><?php echo e($product->name); ?></h1>
          <p class="text-muted mb-3"><?php echo e($product->description ?? 'Cultivated according to strict organic and chemical-free agricultural practices. Freshly picked before market pickup.'); ?></p>

          <div class="display-6 font-serif text-forest mb-4">
            Rs. <?php echo e(number_format($product->price, 2)); ?> <span class="fs-6 text-muted font-sans">/ <?php echo e($product->unit); ?></span>
          </div>

          <div class="card p-3 rounded-20 border-subtle bg-white mb-4">
            <div class="d-flex align-items-center gap-3">
              <i class="bi bi-shop text-forest fs-3"></i>
              <div>
                <strong class="d-block text-forest"><?php echo e($product->farmer->farmerProfile->business_name ?? $product->farmer->name); ?></strong>
                <span class="small text-muted">Stock Available: <strong><?php echo e($product->stock_quantity); ?> <?php echo e($product->unit); ?>s</strong></span>
              </div>
              <a href="<?php echo e(route('farmers.show', $product->farmer)); ?>" class="btn btn-sm btn-outline-forest rounded-pill ms-auto">Farmer Profile</a>
            </div>
          </div>

          <?php if(session('success')): ?>
            <div class="alert alert-success py-2 rounded-12 small mb-3"><?php echo e(session('success')); ?></div>
          <?php endif; ?>
          <?php if(session('error')): ?>
            <div class="alert alert-danger py-2 rounded-12 small mb-3"><?php echo e(session('error')); ?></div>
          <?php endif; ?>

          <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->isCustomer()): ?>
              <form method="POST" action="<?php echo e(route('customer.cart.add')); ?>" class="d-flex gap-3 align-items-center">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <div class="input-group" style="width: 140px;">
                  <button type="button" class="btn btn-outline-secondary" onclick="let q = document.getElementById('qtyInput'); if(q.value > 1) q.value--;">-</button>
                  <input type="number" id="qtyInput" name="quantity" class="form-control text-center" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>">
                  <button type="button" class="btn btn-outline-secondary" onclick="let q = document.getElementById('qtyInput'); if(q.value < <?php echo e($product->stock_quantity); ?>) q.value++;">+</button>
                </div>
                <button type="submit" class="btn btn-forest rounded-pill px-4 py-2 flex-grow-1 shadow-sm">
                  <i class="bi bi-basket3 me-2"></i>Add to Pickup Basket
                </button>
              </form>
            <?php else: ?>
              <div class="alert alert-info py-2 rounded-12 small">
                You are signed in as a <?php echo e(auth()->user()->role); ?>. Switch to a customer account to reserve produce.
              </div>
            <?php endif; ?>
          <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-forest rounded-pill px-4 py-3 w-100 shadow-sm">
              Sign In to Reserve / Add to Basket <i class="bi bi-arrow-right ms-2"></i>
            </a>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>

  <?php if($related->isNotEmpty()): ?>
    <section class="py-5">
      <div class="container">
        <h4 class="font-serif text-forest mb-4">Other Produce in <?php echo e($product->category->name); ?></h4>
        <div class="row g-3">
          <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
              <div class="card p-3 rounded-20 border-subtle shadow-xs bg-white h-100">
                <img src="<?php echo e($rel->image_url); ?>" class="rounded-16 w-100 object-fit-cover mb-2" height="140" alt="<?php echo e($rel->name); ?>">
                <h6 class="font-serif mb-1"><a href="<?php echo e(route('products.show', $rel)); ?>" class="text-forest text-decoration-none"><?php echo e($rel->name); ?></a></h6>
                <p class="small text-forest fw-bold mb-2">Rs. <?php echo e($rel->price); ?> / <?php echo e($rel->unit); ?></p>
                <a href="<?php echo e(route('products.show', $rel)); ?>" class="btn btn-sm btn-outline-forest rounded-pill w-100">View</a>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/products/show.blade.php ENDPATH**/ ?>