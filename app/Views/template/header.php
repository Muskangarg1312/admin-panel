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
  <meta name="csrf-token" content="<?= csrf_hash() ?>">
  <base href="<?= base_url() ?>">
  <link rel="stylesheet" href="<?= base_url() ?>public/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>

    <script type="text/javascript">
      // $.ajaxSetup({
      //   headers: {
      //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      // });
    </script>
  </head>
 <!--  <style>
   #myNewTable td{
   /*padding: unset;*/
    padding-top : 0px!important;
    padding-bottom : 0px!important;
    }
    #myNewTable .m-lg-auto{
    /*      margin-top: -10px!important;*/
    }

    #myNewTable tr:nth-child(1) {
      height: 120px;
    }

    #myNewTable tr:not(:nth-child(1)) {
      height: 70px;
    }
    #myNewTable .add{
      font-size: 35px;
      line-height: 4.5;
    }
    #myNewTable .delete{
      font-size: 35px;
    }
    .select2-container {
      width: 100%!important;
    }
    .form-group1{
      font-size: 0.875rem!important;
    }
    ::placeholder {
      color: black!important;
      opacity: 1; /* Firefox */
    }

    :-ms-input-placeholder { /* Internet Explorer 10-11 */
     color: black!important;
    }

    ::-ms-input-placeholder { /* Microsoft Edge */
     color: black!important;
    }
    .select2-container .select2-selection--single {
      height: 50px!important;
      width: 100%!important;
      border: 1px solid #afafaf;
      font-family: "ubuntu-regular", sans-serif!important;
      font-size: 0.8125rem!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      right: 20px;
      left: unset;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: unset!important; 
      padding: 0.94rem 1.375rem!important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {

      top: 10px!important;

    }
    input, textarea{
     border: 1px solid #afafaf!important;
     height: 50px!important;
    }
    td, th{
      padding: 15px!important;
    }

    .brand-logo-mini img{
      object-fit: cover;
    }
    .brand-logo img{
      height: 60px!important;
      width: 200px!important;
    }

    /*.table-scroll .card-body{
      overflow: auto;
      white-space: nowrap;
    }*/
    @media only screen and (max-width: 1200px) {
      .table-scroll .card-body{
        overflow: auto;
        white-space: nowrap;
      }
      .table-scroll .card-body table{
        display: inline-block;
      }
    }
  </style> -->

<body>

  <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="<?= base_url() ?>"><img src="<?= base_url() ?>public/assets/images/pr-rubber.png" alt="logo" /></a>
      <a class="navbar-brand brand-logo-mini" href="index.php"><img src="<?= base_url() ?>public/assets/images/pr-rubber.png" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item d-none d-lg-block full-screen-link">
          <a class="nav-link">
            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
          </a>
        </li>
        <li class="nav-item nav-logout d-none d-lg-block">
          <a class="nav-link" href="<?= base_url('logout') ?>">
            <i class="mdi mdi-power"></i>
          </a>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <div class="container-fluid page-body-wrapper">
    <?= $this->include('template/sidebar') ?>
