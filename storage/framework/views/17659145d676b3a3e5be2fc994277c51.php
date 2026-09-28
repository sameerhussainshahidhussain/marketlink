<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title', 'MarketLink – eGreen Basket | Modern Luxury Organic Marketplace'); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Discover fresh seasonal produce, explore local farmers markets, and reserve your favorites for convenient pickup with MarketLink.'); ?>">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌿</text></svg>">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
  <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>

  <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main>
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/cart.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/ai-assistant.js')); ?>"></script>
  <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/layouts/app.blade.php ENDPATH**/ ?>