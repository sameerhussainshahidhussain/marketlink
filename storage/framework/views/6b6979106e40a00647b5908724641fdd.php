<?php $__env->startSection('title', 'Meet Our Organic Farmers | MarketLink'); ?>

<?php $__env->startSection('content'); ?>
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Farmers</li>
        </ol>
      </nav>
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <span class="section-tag"><i class="bi bi-person-heart"></i> Local Producers</span>
          <h1 class="display-6 font-serif">Meet Local Organic Farmers & Growers</h1>
          <p class="text-muted mb-0">Discover verified independent growers, learn about regenerative farming practices, and pre-order seasonal items directly.</p>
        </div>
        <div class="col-lg-5">
          <form method="GET" action="<?php echo e(route('farmers.index')); ?>" class="card p-3 rounded-24 border-subtle shadow-sm bg-white">
            <div class="input-group">
              <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
              <input type="text" name="search" class="form-control border-0 shadow-none" value="<?php echo e(request('search')); ?>" placeholder="Search by farmer or farm name...">
              <button class="btn btn-forest rounded-pill px-4">Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col-md-6 col-lg-4">
            <div class="farmer-card h-100 d-flex flex-column border rounded-24 p-4 bg-white shadow-xs">
              <div class="d-flex align-items-center gap-3 mb-3">
                <img src="<?php echo e($farmer->profile_image ? asset('storage/' . $farmer->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=200&auto=format&fit=crop&q=80'); ?>" class="rounded-circle object-fit-cover shadow-sm" width="70" height="70" alt="<?php echo e($farmer->name); ?>">
                <div>
                  <span class="badge bg-sage text-forest rounded-pill px-2 py-1 mb-1 small"><i class="bi bi-patch-check-fill text-emerald me-1"></i>Verified</span>
                  <h5 class="font-serif mb-0"><a href="<?php echo e(route('farmers.show', $farmer)); ?>" class="text-forest text-decoration-none"><?php echo e($farmer->farmerProfile->business_name ?? $farmer->name); ?></a></h5>
                  <p class="small text-muted mb-0"><?php echo e($farmer->name); ?></p>
                </div>
              </div>
              <p class="small text-muted mb-3 flex-grow-1"><?php echo e(Str::limit($farmer->farmerProfile->description ?? 'Cultivating high quality organic vegetables, herbs, and fresh produce.', 120)); ?></p>
              
              <div class="d-flex align-items-center justify-content-between pt-3 border-top border-subtle small mt-auto">
                <span class="text-forest fw-semibold"><i class="bi bi-basket me-1"></i><?php echo e($farmer->products_count); ?> Products</span>
                <a href="<?php echo e(route('farmers.show', $farmer)); ?>" class="btn btn-sm btn-forest rounded-pill px-3">View Profile</a>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-12 text-center py-5">
            <i class="bi bi-people text-muted fs-1 mb-3 d-block"></i>
            <h5 class="font-serif text-muted">No farmers found matching your criteria</h5>
            <a href="<?php echo e(route('farmers.index')); ?>" class="btn btn-outline-forest rounded-pill mt-3">Reset Filters</a>
          </div>
        <?php endif; ?>
      </div>

      <div class="mt-5 d-flex justify-content-center">
        <?php echo e($farmers->links()); ?>

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/farmers/index.blade.php ENDPATH**/ ?>