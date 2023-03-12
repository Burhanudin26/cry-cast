<?php $__env->startSection('title', 'Menu'); ?>
<?php $__env->startSection('content'); ?>
  <!-- content -->
  <div
    class="container pt-5 d-flex flex-column vh-md-100 justify-content-center align-items-center mt-5 mt-md-0 p-5 p-md-0">
    <div class="row row-cols-2 row-cols-md-4 justify-content-center align-items-center gy-2">
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <a href="/menu/eth" style="position: relative; z-index: 1;">
          <div style="pointer-events: none;">
            <img src="/pictures/icon/eth.png" class="img-fluid rounded-circle shadow" alt=""
              style="pointer-events: none;">
          </div>
        </a>
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <img src="/pictures/icon/bitcoin.png" class="img-fluid rounded-circle shadow" alt="">
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <img src="/pictures/icon/tron.png" class="img-fluid rounded-circle shadow" alt="">
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <img src="/pictures/icon/biance.png" class="img-fluid rounded-circle shadow" alt="">
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <img src="/pictures/icon/iota.png" class="img-fluid" alt="">
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <img src="/pictures/icon/stellar.png" class="img-fluid" alt="">
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <img src="/pictures/icon/solana.png" class="img-fluid" alt="">
      </div>
      <div class="col justify-content-center align-items-center d-flex flex-column">
        <img src="/pictures/icon/doge.png" class="img-fluid" alt="">
      </div>
    </div>
  </div>

  <style>
    @media (min-width: 768px) {
      .vh-md-100 {
        height: 100vh;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Laravel\cry-cast2\resources\views/menu.blade.php ENDPATH**/ ?>