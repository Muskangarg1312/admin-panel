<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
  <!--   <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="<?= base_url() ?>public/assets/images/faces/face10.jpg" alt="profile">
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">Muskan Garg</span>
          <span class="text-secondary text-small">Web Developer</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url() ?>">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('day-book') ?>">
        <span class="menu-title">Day Book</span>
        <i class="mdi mdi-book-open menu-icon"></i>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#voucher_entries" aria-expanded="false" aria-controls="entries">
        <span class="menu-title">Voucher Entry</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-database menu-icon"></i>
      </a>
      <div class="collapse" id="voucher_entries">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('entries') ?>">All Entries</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-entry') ?>">Add Entry</a></li>
        </ul>
      </div>
    </li>
     <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#bank_entries" aria-expanded="false" aria-controls="bank_entries">
        <span class="menu-title">Bank Entry</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
      <div class="collapse" id="bank_entries">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('bank-entries') ?>">All Entries</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-bank-entry') ?>">Add Entry</a></li>
        </ul>
      </div>
    </li>
     <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#customer_entries" aria-expanded="false" aria-controls="customer_entries">
        <span class="menu-title">Customer Entry</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-dns menu-icon"></i>
      </a>
      <div class="collapse" id="customer_entries">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('customer-entries') ?>">All Entries</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-customer-entry') ?>">Add Entry</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#sms_charges" aria-expanded="false" aria-controls="sms_charges">
        <span class="menu-title">SMS Charges</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-message-reply-text menu-icon"></i>
      </a>
      <div class="collapse" id="sms_charges">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('sms-charges') ?>">All SMS Charges</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-sms-charge') ?>">Add SMS Charge</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#suppliers" aria-expanded="false" aria-controls="suppliers">
        <span class="menu-title">Suppliers</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-convert menu-icon"></i>
      </a>
      <div class="collapse" id="suppliers">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('suppliers') ?>">All Suppliers</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-supplier') ?>">Add Supplier</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#customers" aria-expanded="false" aria-controls="customers">
        <span class="menu-title">Customers</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-check menu-icon"></i>
      </a>
      <div class="collapse" id="customers">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('customers') ?>">All Customers</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-customer') ?>">Add Customer</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#mmcategory" aria-expanded="false" aria-controls="mmcategory">
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-arrange-bring-forward menu-icon"></i>
      </a>
      <div class="collapse" id="mmcategory">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('categories') ?>">All Categories</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-category') ?>">Add Category</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#sub_category" aria-expanded="false" aria-controls="sub_category">
        <span class="menu-title">Sub Category</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-arrange-bring-to-front menu-icon"></i>
      </a>
      <div class="collapse" id="sub_category">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('sub-categories') ?>">All Sub Categories</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-sub-category') ?>">Add Sub Category</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#bank_accounts" aria-expanded="false" aria-controls="category">
        <span class="menu-title">Bank Account</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-bank menu-icon"></i>
      </a>
      <div class="collapse" id="bank_accounts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('bank-accounts') ?>">All Bank Accounts</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url('add-bank-account') ?>">Add Bank Account</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>