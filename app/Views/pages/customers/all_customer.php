<?= $this->include('template/header') ?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">All Customers</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Customers</li>
                </ol>
            </nav>
        </div>
        <div class="row table-scroll">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">All </h4> -->
                        <!-- <p class="card-description"> Add class <code>.table-striped</code> -->
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
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact Person Name</th>
                                        <th>Contact Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 0;
                                    foreach ($customers as $customer):
                                        $i = $i+1;
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $customer['name'] ?></td>
                                            <td><?= $customer['address'] ?></td>
                                            <td><?= $customer['contact_person_name'] ?></td>
                                            <td><?= $customer['contact_number'] ?></td>
                                            <td><a href="<?= base_url() ?>customers/<?= $customer['id'] ?>/edit" class="btn-sm btn-primary"><i class="mdi mdi-pencil text-white"></i></a> 
                                                <a href="<?= base_url() ?>customers/<?= $customer['id'] ?>/delete" class="confirm_del_btn btn-sm btn-danger" data-id="<?= $customer['id'] ?>" data-keyword="customers"><i class="mdi mdi-delete text-white"></i></td>
                                                </tr>
                                                <?php 
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?= $this->include('template/footer') ?>