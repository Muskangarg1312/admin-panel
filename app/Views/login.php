<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PREMIER LEGGUARD WORKS</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/vendors/css/vendor.bundle.base.css">
  
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/favicon.ico" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img src="<?= base_url() ?>public/assets/images/pr-rubber.png">
              </div>
              <h4 class="text-center">Admin Panel</h4>
              <h6 class="font-weight-light text-center">Log in to continue.</h6>
              <?php
              $validation = \Config\Services::validation();
              $errors = session('validation');
              ?>
              <!-- <h4 class="card-title">Add Supplier</h4> -->
                <?php if(session('message')):?>
                  <div class="alert alert-success">
                    <?= session('message'); ?>
                  </div>
                <?php endif; ?>
                <?php if(session('error')):?>
                  <div class="alert alert-danger">
                    <?= session('error'); ?>
                  </div>
                <?php endif; ?>
                <form class="pt-3" method="post" action="<?= base_url('login') ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="Username" name="username" placeholder="Username" value="<?= old('username') ?>">
                    <?php if ( $errors['username'] ?? false ): ?>
                      <div class="text-danger"><?= $errors['username'] ?? '' ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="Password" name="password" placeholder="Password" value="<?= old('password') ?>">
                    <?php if ( $errors['password'] ?? false ): ?>
                      <div class="text-danger"><?= $errors['password'] ?? '' ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-gradient-primary mb-2">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- <script src="<?= base_url() ?>public/assets/vendors/js/vendor.bundle.base.js"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
   <!--  <script src="<?= base_url() ?>public/assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>public/assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>public/assets/js/misc.js"></script> -->
    <!-- endinject -->
  </body>
  </html>