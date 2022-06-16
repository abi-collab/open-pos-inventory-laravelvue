<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo e(config('app.name', 'Laravel')); ?></title>
  <link rel="stylesheet" href="<?php echo e(mix('/css/app.css')); ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <router-link to="/dashboard" class="brand-link">
      <span class="brand-text font-weight-light"><?php echo e(config('app.name', 'Laravel')); ?></span>
    </router-link>
    <div class="sidebar">
        <router-link to="/profile">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="<?php echo e(auth()->user()->photo); ?>" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <?php echo e(Auth::user()->name); ?>

                  <span class="d-block text-muted">
                    <?php echo e(Ucfirst(Auth::user()->type)); ?>

                  </span>
              </div>
          </div>
        </router-link>
      <?php echo $__env->make('layouts.sidebar-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </aside>
  <div class="content-wrapper">
    
    <br>
    <br>
    <router-view></router-view>
    <vue-progress-bar></vue-progress-bar>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>LARAVEL-VUE </b> POS & INVENTORY SYSTEM
    </div>
  </footer>
</div>
<?php if(auth()->guard()->check()): ?>
<script>
    window.user = <?php echo json_encode(auth()->user(), 15, 512) ?>
</script>
<?php endif; ?>
<script src="<?php echo e(mix('/js/app.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\Abi\open-pos-inventory-laravelvue\resources\views/layouts/master.blade.php ENDPATH**/ ?>