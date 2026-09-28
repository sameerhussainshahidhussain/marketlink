<?php $__env->startSection('title', 'Browse Farmers Markets | MarketLink'); ?>

<?php $__env->startSection('content'); ?>
  
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
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
          <form method="GET" action="<?php echo e(route('markets.index')); ?>" class="card p-3 rounded-24 border-subtle shadow-sm bg-white">
            <div class="input-group">
              <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
              <input type="text" name="search" class="form-control border-0 shadow-none" value="<?php echo e(request('search')); ?>" placeholder="Search by market name or city...">
              <button class="btn btn-forest rounded-pill px-4">Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
          <h4 class="font-serif mb-1">Active Community Markets (<?php echo e($markets->total()); ?>)</h4>
          <p class="text-muted small mb-0">Showing certified farmers markets open for seasonal pickup reservations.</p>
        </div>
        <div class="d-flex gap-2">
          <a href="<?php echo e(route('markets.index')); ?>" class="btn btn-sm btn-outline-forest rounded-pill <?php echo e(!request('day') ? 'active' : ''); ?>">All Days</a>
          <a href="<?php echo e(route('markets.index', ['day' => 'Saturday'])); ?>" class="btn btn-sm btn-outline-forest rounded-pill <?php echo e(request('day') == 'Saturday' ? 'active' : ''); ?>">Saturday</a>
          <a href="<?php echo e(route('markets.index', ['day' => 'Sunday'])); ?>" class="btn btn-sm btn-outline-forest rounded-pill <?php echo e(request('day') == 'Sunday' ? 'active' : ''); ?>">Sunday</a>
          <a href="<?php echo e(route('markets.index', ['day' => 'Friday'])); ?>" class="btn btn-sm btn-outline-forest rounded-pill <?php echo e(request('day') == 'Friday' ? 'active' : ''); ?>">Friday</a>
        </div>
      </div>

      <div class="row g-4" id="marketsGrid">
        <?php $__empty_1 = true; $__currentLoopData = $markets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $market): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col-md-6 col-lg-4">
            <div class="market-card h-100 d-flex flex-column">
              <div class="card-image-wrap">
                <span class="card-badge-top"><i class="bi bi-calendar3"></i> <?php echo e($market->operating_days); ?></span>
                <span class="card-badge-distance"><i class="bi bi-geo-alt"></i> <?php echo e($market->city); ?></span>
                <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=600&auto=format&fit=crop&q=80" alt="<?php echo e($market->market_name); ?>" class="card-img-top">
              </div>
              <div class="card-body-custom flex-grow-1 d-flex flex-column">
                <h5 class="font-serif fs-5 mb-1">
                  <a href="<?php echo e(route('markets.show', $market)); ?>" class="text-forest text-decoration-none"><?php echo e($market->market_name); ?></a>
                </h5>
                <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-emerald"></i><?php echo e($market->address); ?>, <?php echo e($market->city); ?></p>
                <p class="small text-muted mb-3 flex-grow-1"><?php echo e(Str::limit($market->description, 120)); ?></p>
                <div class="d-flex align-items-center gap-3 py-2 my-2 border-top border-bottom border-subtle small">
                  <div><i class="bi bi-clock me-1 text-gold"></i><?php echo e(date('h:i A', strtotime($market->opening_time))); ?> - <?php echo e(date('h:i A', strtotime($market->closing_time))); ?></div>
                  <div class="ms-auto"><i class="bi bi-people me-1 text-forest"></i><strong><?php echo e($market->farmers_count); ?></strong> Farmers</div>
                </div>
                <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                  <span class="badge bg-sage text-forest px-3 py-2 rounded-pill"><i class="bi bi-check-circle me-1"></i>Active Market</span>
                  <a href="<?php echo e(route('markets.show', $market)); ?>" class="btn btn-sm btn-forest rounded-pill px-3">View Market</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-12 py-5 text-center">
            <i class="bi bi-shop text-muted fs-1 mb-3 d-block"></i>
            <h5 class="font-serif text-muted">No markets found matching your criteria</h5>
            <a href="<?php echo e(route('markets.index')); ?>" class="btn btn-outline-forest rounded-pill mt-3">Reset Filters</a>
          </div>
        <?php endif; ?>
      </div>

      <div class="mt-5 d-flex justify-content-center">
        <?php echo e($markets->links()); ?>

      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/markets/index.blade.php ENDPATH**/ ?>