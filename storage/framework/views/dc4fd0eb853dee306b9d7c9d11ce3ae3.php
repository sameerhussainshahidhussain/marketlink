<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title', 'Dashboard | MarketLink'); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'MarketLink Dashboard'); ?>">

  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌿</text></svg>">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashboard.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">

  <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="dashboard-body <?php echo $__env->yieldContent('body_class'); ?> role-<?php echo e(auth()->user()->role ?? 'guest'); ?>">

  <div class="dashboard-wrapper dashboard-<?php echo e(auth()->user()->role ?? 'portal'); ?>-wrapper <?php echo $__env->yieldContent('wrapper_class'); ?>">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <?php echo $__env->yieldContent('sidebar'); ?>

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn">
            <i class="bi bi-list fs-5"></i>
          </button>
          <div>
            <h5 class="font-serif mb-0"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></h5>
            <span class="small text-muted"><?php echo $__env->yieldContent('page_subtitle', ''); ?></span>
          </div>
        </div>
        <div class="topbar-right">
          <?php echo $__env->yieldContent('topbar_right'); ?>
        </div>
      </header>

      <div class="dashboard-container">
        <?php if(session('success')): ?>
          <div class="alert alert-success py-2 rounded-12 small mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill text-success"></i>
            <?php echo e(session('success')); ?>

          </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
          <div class="alert alert-danger py-2 rounded-12 small mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-circle-fill text-danger"></i>
            <?php echo e(session('error')); ?>

          </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
          <div class="alert alert-danger py-2 rounded-12 small mb-4">
            <ul class="mb-0 ps-3">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/dashboard.js')); ?>"></script>

  <script>
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const sidebar   = document.querySelector('.dashboard-sidebar');
    const overlay   = document.getElementById('sidebarOverlay');

    if (toggleBtn && sidebar && overlay) {
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
      });
      overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      });
    }
  </script>

  <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>