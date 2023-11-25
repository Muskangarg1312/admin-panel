<?= $this->include('template/header') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">All Bank Accounts</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Bank Accounts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Bank Accounts</li>
                </ol>
            </nav>
        </div>
        <div class="row table-scroll">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">All Bank Accounts</h4> -->
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
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 0;
                                    foreach ($bank_accounts as $bank_account):
                                        $i = $i+1;
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $bank_account['name'] ?></td>
                                            <td><?= $bank_account['description'] ?></td>
                                            <td><a href="<?= base_url() ?>bank-accounts/<?= $bank_account['id'] ?>/edit" class="btn-sm btn-primary"><i class="mdi mdi-pencil text-white"></i></a> 
                                                <a href="<?= base_url() ?>bank-accounts/<?= $bank_account['id'] ?>/delete" class="confirm_del_btn btn-sm btn-danger" data-id="<?= $bank_account['id'] ?>" data-keyword="bank-accounts"><i class="mdi mdi-delete text-white"></i></td>
                                                </tr>
                                                <?php 
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?= $this->include('template/footer') ?>